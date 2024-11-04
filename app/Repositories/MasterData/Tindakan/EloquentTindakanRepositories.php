<?php

namespace App\Repositories\MasterData\Tindakan;

/**
 * import component
 */

use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\DB;
use App\Exceptions\CustomException;

/**
 * import traits
 */

use App\Traits\Message;
use App\Traits\Response;

/**
 * import models
 */

use App\Models\MasterData\Tindakan\Tindakan\Tindakan;

/**
 * import helpers
 */

use App\Helpers\CheckerHelpers;

/**
 * import interface
 */

use App\Repositories\MasterData\Tindakan\TindakanRepositories;

class EloquentTindakanRepositories implements TindakanRepositories
{
    use Message, Response;

    private $tindakan;
    private $checkerHelpers;

    public function __construct(
        Tindakan $tindakan,
        CheckerHelpers $checkerHelpers,
    ) {
        /**
         * initialize model
         */
        $this->tindakan = $tindakan;

        /**
         * initialize helper
         */
        $this->checkerHelpers = $checkerHelpers;
    }

    /**
     * where condition
     */
    private function whereCondition($uuidFaskes = null, $uuidTindakan = null)
    {
        $whereCondition = [
            authAttribute()['role'] == 'superadmin' ? ['tindakan.uuid_faskes' => $uuidFaskes] : ['tindakan.uuid_faskes' => authAttribute()['id_faskes']],
            authAttribute()['role'] == 'superadmin' ? ['tindakan.uuid_tindakan' => $uuidTindakan] : ['tindakan.uuid_tindakan' => $uuidTindakan, 'tindakan.uuid_faskes' => authAttribute()['id_faskes']]
        ];
        return $whereCondition;
    }

    /**
     * all record
     */
    public function data($uuidPoliLinkKlinik, $uuidFaskes)
    {
        try {

            /**
             * data tindakan
             */
            $data = $this->tindakan->join('tindakan_kategori', 'tindakan_kategori.uuid_tindakan_kategori', '=', 'tindakan.uuid_tindakan_kategori')
                ->select(
                    'tindakan_kategori.kategori',
                    'tindakan.uuid_tindakan',
                    'tindakan.nama',
                    'tindakan.kode',
                    'tindakan.harga',
                    'tindakan.uuid_poliklinik_link_klinik',
                    'tindakan.uuid_faskes'
                )
                ->where($this->whereCondition($uuidFaskes)[0])
                ->Where(['uuid_poliklinik_link_klinik' => $uuidPoliLinkKlinik])
                ->get();

            if (count($data) <= 0) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'tindakan'), 404]));
            endif;

            $response = $this->sendResponse(null, 200, $data);
        } catch (CustomException $ex) {
            $ex = json_decode($ex->getMessage());
            $response = $this->sendResponse($ex[0], $ex[1]);
        } catch (\Exception $e) {
            $response = $this->sendResponse($e->getMessage(), 500);
        }

        return $response;
    }

    /**
     * get data by uuid
     */
    public function get($uuidTindakan)
    {
        try {
            /**
             * get single data
             */
            $getTindakan = $this->checkerHelpers->tindakanChecker($this->whereCondition(null, $uuidTindakan)[1]);
            if (is_null($getTindakan)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'tindakan'), 404]));
            endif;
            $getTindakan['tindakan_harga'] = json_decode($getTindakan->tindakan_harga);
            $getTindakan = collect($getTindakan)->except(['uuid_faskes'])->toArray();

            $response = $this->sendResponse(null, 200, $getTindakan);
        } catch (CustomException $ex) {
            $ex = json_decode($ex->getMessage());
            $response = $this->sendResponse($ex[0], $ex[1]);
        } catch (\Exception $e) {
            $response = $this->sendResponse($e->getMessage(), 500);
        }

        return $response;
    }

    /**
     * store data to db
     */
    public function store($request)
    {
        DB::beginTransaction();
        try {

            /**
             * set tindakan harga value
             */
            $tindakanHarga = null;
            if (isset($request['uuid_jenis_pembayaran'])) :
                $tindakanHarga = [];
                foreach ($request['uuid_jenis_pembayaran'] as $key => $value) :
                    $set = [
                        'uuid_jenis_pembayaran' => $value,
                        'harga_jual' => $request['harga_jual'][$key]
                    ];
                    array_push($tindakanHarga, $set);
                endforeach;
                $tindakanHarga = json_encode($tindakanHarga);
            endif;
            $request['tindakan_harga'] = $tindakanHarga;

            $request = collect($request)->except(['uuid_jenis_pembayaran', 'harga_jual'])->toArray();

            $saveData = $this->tindakan->create($request);
            //===============================================================================

            if (!$saveData) :
                throw new \Exception($this->outputMessage('unsaved', $request['nama']));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('saved', $request['nama']), 201, null);
        } catch (CustomException $ex) {
            $ex = json_decode($ex->getMessage());
            $response = $this->sendResponse($ex[0], $ex[1]);
        } catch (\Exception $e) {
            DB::rollback();
            $response = $this->sendResponse($e->getMessage(), 500);
        }

        /**
         * send response to controller
         */
        return $response;
    }

    /**
     * update data to db
     */
    public function update($request, $uuidTindakan)
    {
        DB::beginTransaction();
        try {

            /**
             * validation data
             */
            $getTindakan = $this->checkerHelpers->tindakanChecker($this->whereCondition(null, $uuidTindakan)[1]);
            if (is_null($getTindakan)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'tindakan'), 404]));
            endif;

            /**
             * set tindakan harga value
             */
            $tindakanHarga = null;
            if (isset($request['uuid_jenis_pembayaran'])) :
                $tindakanHarga = [];
                foreach ($request['uuid_jenis_pembayaran'] as $key => $value) :
                    $set = [
                        'uuid_jenis_pembayaran' => $value,
                        'harga_jual' => $request['harga_jual'][$key]
                    ];
                    array_push($tindakanHarga, $set);
                endforeach;
                $tindakanHarga = json_encode($tindakanHarga);
            endif;
            $request['tindakan_harga'] = $tindakanHarga;

            /**
             * update data
             */
            $request = collect($request)->except(['uuid_jenis_pembayaran', 'harga_jual', '_method'])->toArray();
            $updateTindakan = $this->tindakan->where($this->whereCondition(null, $uuidTindakan)[1])->update($request);
            if (!$updateTindakan) :
                throw new \Exception($this->outputMessage('update fail', $request['nama']));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('updated', $request['nama']), 200, null);
        } catch (CustomException $ex) {
            $ex = json_decode($ex->getMessage());
            $response = $this->sendResponse($ex[0], $ex[1]);
        } catch (\Exception $e) {
            DB::rollback();
            $response = $this->sendResponse($e->getMessage(), 500);
        }

        /**
         * send response to controller
         */
        return $response;
    }

    /**
     * delete data from db
     */
    public function delete($uuidTindakan)
    {
        DB::beginTransaction();
        try {
            /**
             * check data
             */
            $getData = $this->checkerHelpers->tindakanChecker($this->whereCondition(null, $uuidTindakan)[1]);
            if (is_null($getData)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'tindakan'), 404]));
            endif;
            $tindakan = $getData->nama;

            /**
             * deleted data Tindakan
             */
            $delete = $this->tindakan->where($this->whereCondition(null, $uuidTindakan)[1])->delete();
            if (!$delete) :
                throw new \Exception($this->outputMessage('undeleted', $tindakan));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('deleted', $tindakan), 200);
        } catch (CustomException $ex) {
            $ex = json_decode($ex->getMessage());
            $response = $this->sendResponse($ex[0], $ex[1]);
        } catch (\Exception $e) {
            DB::rollback();
            $response = $this->sendResponse($e->getMessage(), 500);
        }

        return $response;
    }
}
