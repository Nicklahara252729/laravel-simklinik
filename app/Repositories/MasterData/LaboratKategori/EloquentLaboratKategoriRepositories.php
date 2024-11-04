<?php

namespace App\Repositories\MasterData\LaboratKategori;

/**
 * import component
 */

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

use App\Models\MasterData\Laborat\LaboratKategori\LaboratKategori;


/**
 * import helpers
 */

use App\Helpers\CheckerHelpers;

/**
 * import interface
 */

use App\Repositories\MasterData\LaboratKategori\LaboratKategoriRepositories;

class EloquentLaboratKategoriRepositories implements LaboratKategoriRepositories
{
    use Message, Response;

    private $laboratKategori;
    private $checkerHelpers;

    public function __construct(
        LaboratKategori $laboratKategori,
        CheckerHelpers $checkerHelpers,
    ) {
        /**
         * initialize model
         */
        $this->laboratKategori = $laboratKategori;

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
            authAttribute()['role'] == 'superadmin' ? ['uuid_laborat_kategori' => $uuidLaborat] : ['uuid_laborat_kategori' => $uuidLaborat, 'uuid_faskes' => authAttribute()['id_faskes']]
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
             * data laborat kategori
             */
            $data = $this->laboratKategori->where($this->whereCondition($uuidFaskes)[0])
                ->get(['uuid_laborat_kategori', 'kategori']);
            if (count($data) <= 0) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'laborat kategori'), 404]));
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
    public function get($uuidLaboratKategori)
    {
        try {
            /**
             * get single data
             */

            $getLaboratKategori = $this->checkerHelpers->laboratKategoriChecker($this->whereCondition(null, $uuidLaboratKategori)[1]);
            if (is_null($getLaboratKategori)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'laborat kategori'), 404]));
            endif;

            $response = $this->sendResponse(null, 200, $getLaboratKategori);
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
             * save data laborat kategori
             */
            $saveData = $this->laboratKategori->create($request);
            if (!$saveData) :
                throw new \Exception($this->outputMessage('unsaved', $request['kategori']));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('saved', $request['kategori']), 201, null);
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
    public function update($request, $uuidLaboratKategori)
    {
        DB::beginTransaction();
        try {
            /**
             * validation data
             */
            $getLaboratKategori = $this->checkerHelpers->laboratKategoriChecker($this->whereCondition(null, $uuidLaboratKategori)[1]);
            if (is_null($getLaboratKategori)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'laborat kategori'), 404]));
            endif;

            /**
             * update data
             */
            $request = collect($request)->except(['_method'])->toArray();
            $updateLaboratKategori = $this->laboratKategori->where($this->whereCondition(null, $uuidLaboratKategori)[1])
                ->update($request);
            if (!$updateLaboratKategori) :
                throw new \Exception($this->outputMessage('update fail', $request['kategori']));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('updated', $request['kategori']), 200, null);
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
    public function delete($uuidLaboratKategori)
    {
        DB::beginTransaction();
        try {
            /**
             * check data
             */
            $getData = $this->checkerHelpers->laboratKategoriChecker($this->whereCondition(null, $uuidLaboratKategori)[1]);
            if (is_null($getData)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'laborat kategori'), 404]));
            endif;
            $laboratKategori = $getData->kategori;

            /**
             * deleted data
             */
            $delete = $this->laboratKategori->where($this->whereCondition(null, $uuidLaboratKategori)[1])->delete();
            if (!$delete) :
                throw new \Exception($this->outputMessage('undeleted', $laboratKategori));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('deleted', $laboratKategori), 200);
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
