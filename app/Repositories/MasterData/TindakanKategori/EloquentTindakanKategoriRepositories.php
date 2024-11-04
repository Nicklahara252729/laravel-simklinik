<?php

namespace App\Repositories\MasterData\TindakanKategori;

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

use App\Models\MasterData\Tindakan\TindakanKategori\TindakanKategori;

/**
 * import helpers
 */

use App\Helpers\CheckerHelpers;

/**
 * import interface
 */

use App\Repositories\MasterData\TindakanKategori\TindakanKategoriRepositories;

class EloquentTindakanKategoriRepositories implements TindakanKategoriRepositories
{
    use Message, Response;

    private $tindakanKategori;
    private $checkerHelpers;

    public function __construct(
        TindakanKategori $tindakanKategori,
        CheckerHelpers $checkerHelpers,
    ) {
        /**
         * initialize model
         */
        $this->tindakanKategori = $tindakanKategori;

        /**
         * initialize helper
         */
        $this->checkerHelpers = $checkerHelpers;
    }

    /**
     * where condition
     */
    private function whereCondition($uuidFaskes = null, $uuidTindakanKategori = null)
    {
        $whereCondition = [
            authAttribute()['role'] == 'superadmin' ? ['uuid_faskes' => $uuidFaskes] : ['uuid_faskes' => authAttribute()['id_faskes']],
            authAttribute()['role'] == 'superadmin' ? ['uuid_tindakan_kategori' => $uuidTindakanKategori] : ['uuid_tindakan_kategori' => $uuidTindakanKategori, 'uuid_faskes' => authAttribute()['id_faskes']]
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
             * data tindakan kategori
             */
            $data = $this->tindakanKategori->where($this->whereCondition($uuidFaskes)[0])
                ->get(['uuid_tindakan_kategori', 'kategori']);
            if (count($data) <= 0) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'tindakan kategori'), 404]));
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
    public function get($uuidTindakanKategori)
    {
        try {
            /**
             * get single data
             */

            $getTindakanKategori = $this->checkerHelpers->tindakanKategoriChecker($this->whereCondition(null, $uuidTindakanKategori)[1]);
            if (is_null($getTindakanKategori)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'tindakan kategori'), 404]));
            endif;

            $response = $this->sendResponse(null, 200, $getTindakanKategori);
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
             * save data tindakan kategori
             */
            $saveData = $this->tindakanKategori->create($request);
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
    public function update($request, $uuidTindakanKategori)
    {
        DB::beginTransaction();
        try {
            /**
             * validation data
             */
            $getTindakanKategori = $this->checkerHelpers->tindakanKategoriChecker($this->whereCondition(null, $uuidTindakanKategori)[1]);
            if (is_null($getTindakanKategori)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'tindakan kategori'), 404]));
            endif;

            /**
             * update data
             */
            $request = collect($request)->except(['_method'])->toArray();
            $updateTindakanKategori = $this->tindakanKategori->where($this->whereCondition(null, $uuidTindakanKategori)[1])
                ->update($request);
            if (!$updateTindakanKategori) :
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
    public function delete($uuidTindakanKategori)
    {
        DB::beginTransaction();
        try {
            /**
             * check data
             */
            $getData = $this->checkerHelpers->tindakanKategoriChecker($this->whereCondition(null, $uuidTindakanKategori)[1]);
            if (is_null($getData)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'tindakan kategori'), 404]));
            endif;
            $tindakanKategori = $getData->kategori;

            /**
             * deleted data
             */
            $delete = $this->tindakanKategori->where($this->whereCondition(null, $uuidTindakanKategori)[1])->delete();
            if (!$delete) :
                throw new \Exception($this->outputMessage('undeleted', $tindakanKategori));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('deleted', $tindakanKategori), 200);
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
