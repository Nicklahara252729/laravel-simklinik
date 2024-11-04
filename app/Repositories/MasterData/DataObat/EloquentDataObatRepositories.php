<?php

namespace App\Repositories\MasterData\DataObat;

/**
 * import component
 */

use App\Exceptions\CustomException;
use Illuminate\Support\Facades\DB;

/**
 * import traits
 */

use App\Traits\Response;
use App\Traits\Message;


/**
 * import models
 */

use App\Models\MasterData\DataObat\DataObat;

/**
 * import helpers
 */

use App\Helpers\CheckerHelpers;

/**
 * import interface
 */

use App\Repositories\MasterData\DataObat\DataObatRepositories;

class EloquentDataObatRepositories implements DataObatRepositories
{
    use Message, Response;

    private $dataObat;
    private $checkerHelpers;
    private $days;

    public function __construct(
        DataObat $dataObat,
        CheckerHelpers $checkerHelpers,
    ) {
        /**
         * initialize model
         */
        $this->dataObat = $dataObat;

        /**
         * initialize helper
         */
        $this->checkerHelpers = $checkerHelpers;

        /**
         * static value
         */
        $this->days = daysAttribute();
    }

    /**
     * where condition
     */
    private function whereCondition($uuidFaskes = null, $uuidDataObat = null)
    {
        $whereCondition = [
            authAttribute()['role'] == 'superadmin' ? ['uuid_faskes' => $uuidFaskes] : ['uuid_faskes' => authAttribute()['id_faskes']],
            authAttribute()['role'] == 'superadmin' ? ['uuid_data_obat' => $uuidDataObat] : ['uuid_data_obat' => $uuidDataObat, 'uuid_faskes' => authAttribute()['id_faskes']],
        ];
        return $whereCondition;
    }

    /**
     * all record
     */
    public function data($uuidFaskes)
    {
        try {

            /**
             * data obat
             */
            $data = $this->dataObat->select(
                'uuid_data_obat',
                'kode',
                'nama',
                'satuan',
                'harga_satuan',
                'harga_beli',
                'no_batch',
                DB::raw("DATE_FORMAT(tgl_expired, '%d %M %Y') AS expired"),
                'status',
                'pabrikan',
                'distributor',
                'stock',
                'modal'
            )
                ->join('satuan_obat', 'satuan_obat.uuid_satuan_obat', '=', 'data_obat.uuid_satuan_obat')
                ->join('klasifikasi_obat', 'klasifikasi_obat.uuid_klasifikasi_obat', '=', 'data_obat.uuid_klasifikasi_obat')
                ->where($this->whereCondition($uuidFaskes)[0])
                ->get();

            if (count($data) <= 0) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'data obat'), 404]));
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
    public function get($uuidDataObat)
    {
        try {
            /**
             * get single data
             */
            $getDataObat = $this->checkerHelpers->dataObatChecker($this->whereCondition(null, $uuidDataObat)[1]);
            if (is_null($getDataObat)) :
                throw new \Exception($this->outputMessage('not found', 'data obat'));
            endif;
            $getDataObat['harga_obat'] = json_decode($getDataObat->harga_obat);

            $response = $this->sendResponse(null, 200, $getDataObat);
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
             * set harga obat value
             */
            $hargaObat = null;
            if (isset($request['uuid_jenis_pembayaran'])) :
                $hargaObat = [];
                foreach ($request['uuid_jenis_pembayaran'] as $key => $value) :
                    $set = [
                        'uuid_jenis_pembayaran' => $value,
                        'harga_jual' => $request['harga_jual'][$key],
                    ];
                    array_push($hargaObat, $set);
                endforeach;
                $hargaObat = json_encode($hargaObat);
            endif;
            $request['harga_obat'] = $hargaObat;

            /**
             * save data menu
             */
            $request = collect($request)->except(['uuid_jenis_pembayaran', 'harga_jual'])->toArray();
            $saveData = $this->dataObat->create($request);
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
    public function update($request, $uuidDataObat)
    {
        DB::beginTransaction();
        try {
            /**
             * set harga obat value
             */
            $hargaObat = null;
            if (isset($request['uuid_jenis_pembayaran'])) :
                $hargaObat = [];
                foreach ($request['uuid_jenis_pembayaran'] as $key => $value) :
                    $set = [
                        'uuid_jenis_pembayaran' => $value,
                        'harga_jual' => $request['harga_jual'][$key],
                    ];
                    array_push($hargaObat, $set);
                endforeach;
                $hargaObat = json_encode($hargaObat);
            endif;
            $request['harga_obat'] = $hargaObat;

            /**
             * validation data
             */
            $getObat = $this->checkerHelpers->dataObatChecker($this->whereCondition(null, $uuidDataObat)[1]);
            if (is_null($getObat)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'data obat'), 404]));
            endif;
            $nama = isset($request['nama']) ? $request['nama'] : $getObat->nama;

            /**
             * update data
             */
            $request = collect($request)->except(['uuid_jenis_pembayaran', 'harga_jual', '_method'])->toArray();
            $update = $this->dataObat->where(['uuid_data_obat' => $uuidDataObat])->update($request);
            if (!$update) :
                throw new \Exception($this->outputMessage('update fail', $nama));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('updated', $nama), 200, null);
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
    public function delete($uuidDataObat)
    {
        DB::beginTransaction();
        try {
            /**
             * check data
             */
            $getData = $this->checkerHelpers->dataObatChecker($this->whereCondition(null, $uuidDataObat)[1]);
            if (is_null($getData)) :
                throw new \Exception($this->outputMessage('not found', 'obat'));
            endif;
            $obat = $getData->nama;

            /**
             * deleted data
             */
            $delete = $this->dataObat->where('uuid_data_obat', $uuidDataObat)->delete();
            if (!$delete) :
                throw new \Exception($this->outputMessage('undeleted', $obat));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('deleted', $obat), 200);
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
