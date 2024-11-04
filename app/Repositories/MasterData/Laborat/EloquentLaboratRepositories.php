<?php

namespace App\Repositories\MasterData\Laborat;

/**
 * import component
 */

use Illuminate\Support\Facades\DB;
use App\Exceptions\CustomException;

/**
 * import traits
 */

use App\Models\MasterData\Laborat\Laborat\Laborat;

/**
 * import models
 */

use App\Traits\Message;
use App\Traits\Response;

/**
 * import helpers
 */

use App\Helpers\CheckerHelpers;


/**
 * import interface
 */

use App\Repositories\MasterData\Laborat\LaboratRepositories;

class EloquentLaboratRepositories implements LaboratRepositories
{
    use Message, Response;

    private $laborat;
    private $checkerHelpers;

    public function __construct(
        Laborat $laborat,
        CheckerHelpers $checkerHelpers,
    ) {
        /**
         * initialize model
         */
        $this->laborat = $laborat;

        /**
         * initialize helper
         */
        $this->checkerHelpers = $checkerHelpers;
    }

    /**
     * where condition
     */
    private function whereCondition($uuidFaskes = null, $uuidLaborat = null)
    {
        $whereCondition = [
            authAttribute()['role'] == 'superadmin' ? ['uuid_faskes' => $uuidFaskes] : ['uuid_faskes' => authAttribute()['id_faskes']],
            authAttribute()['role'] == 'superadmin' ? ['uuid_laborat' => $uuidLaborat] : ['uuid_laborat' => $uuidLaborat, 'uuid_faskes' => authAttribute()['id_faskes']]
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
             * data laborat
             */
            $data = $this->laborat->select('uuid_laborat', 'nama', 'kode', 'harga')
                ->where($this->whereCondition($uuidFaskes)[0])
                ->get();

            if (count($data) <= 0) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'laborat'), 404]));
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
    public function get($uuidLaborat)
    {
        try {
            /**
             * get single data
             */

            $getLaborat = $this->checkerHelpers->laboratChecker(["uuid_laborat" => $uuidLaborat]);
            if (is_null($getLaborat)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'laborat'), 404]));
            endif;
            $getLaborat['laborat_harga'] = json_decode($getLaborat->laborat_harga);
            $response = $this->sendResponse(null, 200, $getLaborat);
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
             * set laborat harga value
             */
            $laboratHarga = null;
            if (isset($request['uuid_jenis_pembayaran'])) :
                $laboratHarga = [];
                foreach ($request['uuid_jenis_pembayaran'] as $key => $value) :
                    $set = [
                        'uuid_jenis_pembayaran' => $value,
                        'harga_jual' => $request['harga_jual'][$key],
                    ];
                    array_push($laboratHarga, $set);
                endforeach;
                $laboratHarga = json_encode($laboratHarga);
            endif;
            $request['laborat_harga'] = $laboratHarga;

            /**
             * save data laborat
             */
            $request['uuid_faskes'] = authAttribute()['role'] == 'superadmin' ? $request['uuid_faskes'] : authAttribute()['id_faskes'];
            $request = collect($request)->except(['uuid_jenis_pembayaran', 'harga_jual'])->toArray();
            $saveData = $this->laborat->create($request);
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
    public function update($request, $uuidLaborat)
    {
        DB::beginTransaction();
        try {

            /**
             * validation data
             */
            $getLaborat = $this->checkerHelpers->laboratChecker($this->whereCondition(null, $uuidLaborat)[1]);
            if (is_null($getLaborat)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'laborat'), 404]));
            endif;

            /**
             * set laborat harga value
             */
            $laboratHarga = null;
            if (isset($request['uuid_jenis_pembayaran'])) :
                $laboratHarga = [];
                foreach ($request['uuid_jenis_pembayaran'] as $key => $value) :
                    $set = [
                        'uuid_jenis_pembayaran' => $value,
                        'harga_jual' => $request['harga_jual'][$key],
                    ];
                    array_push($laboratHarga, $set);
                endforeach;
                $laboratHarga = json_encode($laboratHarga);
            endif;
            $request['laborat_harga'] = $laboratHarga;

            /**
             * update data
             */
            $request = collect($request)->except(['uuid_jenis_pembayaran', 'harga_jual', '_method'])->toArray();
            $updateLaborat = $this->laborat->where(['uuid_laborat' => $uuidLaborat])->update($request);
            if (!$updateLaborat) :
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
    public function delete($uuidLaborat)
    {
        DB::beginTransaction();
        try {
            /**
             * check data
             */
            $getData = $this->checkerHelpers->laboratChecker($this->whereCondition(null, $uuidLaborat)[1]);
            if (is_null($getData)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'laborat'), 404]));
            endif;
            $laborat = $getData->nama;

            /**
             * deleted data
             */
            $delete = $this->laborat->where($this->whereCondition(null, $uuidLaborat)[1])->delete();
            if (!$delete) :
                throw new \Exception($this->outputMessage('undeleted', $laborat));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('deleted', $laborat), 200);
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
