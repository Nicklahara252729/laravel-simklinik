<?php

namespace App\Repositories\MasterData\Diagnosa;

/**
 * import component
 */

use Illuminate\Support\Facades\DB;
use App\Exceptions\CustomException;

/**
 * import traits
 */

use App\Traits\Response;
use App\Traits\Message;

/**
 * import models
 */

use App\Models\MasterData\Diagnosa\Diagnosa;

/**
 * import helpers
 */

use App\Helpers\CheckerHelpers;

/**
 * import interface
 */

use App\Repositories\MasterData\Diagnosa\DiagnosaRepositories;

class EloquentDiagnosaRepositories implements DiagnosaRepositories
{
    use Message, Response;

    private $diagnosa;
    private $checkerHelpers;

    public function __construct(
        Diagnosa $diagnosa,
        CheckerHelpers $checkerHelpers,
    ) {
        /**
         * initialize model
         */
        $this->diagnosa = $diagnosa;

        /**
         * initialize helper
         */
        $this->checkerHelpers = $checkerHelpers;
    }

    /**
     * all record
     */
    public function data()
    {
        try {

            /**
             * data tindakan
             */
            $data = $this->diagnosa->select('code', 'diagnosa')->get();
            if (count($data) <= 0) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'diagnosa'), 404]));
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
     * get data by code
     */
    public function get($code)
    {
        try {
            /**
             * get single data
             */

            $getDiagnosa = $this->checkerHelpers->diagnosaChecker(["code" => $code]);
            if (is_null($getDiagnosa)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'diagnosa'), 404]));
            endif;

            $response = $this->sendResponse(null, 200, $getDiagnosa);
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
             * save data tindakan
             */
            $saveData = $this->diagnosa->create($request);
            if (!$saveData) :
                throw new \Exception($this->outputMessage('unsaved', $request['diagnosa']));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('saved', $request['diagnosa']), 201, null);
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
    public function update($request, $code)
    {
        DB::beginTransaction();
        try {
            /**
             * validation data
             */
            $getDiagnosa = $this->checkerHelpers->diagnosaChecker(["code" => $code]);
            if (is_null($getDiagnosa)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'diagnosa'), 404]));
            endif;

            /**
             * update data
             */
            $request = collect($request)->except(['_method'])->toArray();
            $updateDiagnosa = $this->diagnosa->where(['code' => $code])->update($request);
            if (!$updateDiagnosa) :
                throw new \Exception($this->outputMessage('update fail', $request['diagnosa']));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('updated', $request['diagnosa']), 200, null);
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
    public function delete($code)
    {
        DB::beginTransaction();
        try {
            /**
             * check data
             */
            $getData = $this->checkerHelpers->diagnosaChecker(["code" => $code]);
            if (is_null($getData)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'diagnosa'), 404]));
            endif;
            $diagnosa = $getData->diagnosa;

            /**
             * deleted data
             */
            $delete = $this->diagnosa->where('code', $code)->delete();
            if (!$delete) :
                throw new \Exception($this->outputMessage('undeleted', $diagnosa));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('deleted', $diagnosa), 200);
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
