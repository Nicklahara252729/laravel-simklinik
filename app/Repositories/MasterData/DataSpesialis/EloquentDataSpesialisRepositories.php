<?php

namespace App\Repositories\MasterData\DataSpesialis;

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

use App\Models\MasterData\DataSpesialis\DataSpesialis;

/**
 * import helpers
 */

use App\Helpers\CheckerHelpers;

/**
 * import interface
 */

use App\Repositories\MasterData\DataSpesialis\DataSpesialisRepositories;

class EloquentDataSpesialisRepositories implements DataSpesialisRepositories
{
    use Message, Response;

    private $dataSpesialis;
    private $checkerHelpers;

    public function __construct(
        DataSpesialis $dataSpesialis,
        CheckerHelpers $checkerHelpers,
    ) {
        /**
         * initialize model
         */
        $this->dataSpesialis = $dataSpesialis;

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
             * data
             */
            $data = $this->dataSpesialis->get();
            if (count($data) <= 0) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'spesialis'), 404]));
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
    public function get($uuidDataSpesialis)
    {
        try {
            /**
             * get single data
             */
            $getData = $this->checkerHelpers->dataSpesialisChecker(["uuid_spesialis" => $uuidDataSpesialis]);
            if (is_null($getData)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'spesialis'), 404]));
            endif;

            $response = $this->sendResponse(null, 200, $getData);
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
             * save data
             */
            $saveData = $this->dataSpesialis->create($request);
            if (!$saveData) :
                throw new \Exception($this->outputMessage('unsaved', $request['spesialis']));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('saved', $request['spesialis']), 201, null);
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
    public function update($request, $uuidDataSpesialis)
    {
        DB::beginTransaction();
        try {
            /**
             * validation data
             */
            $getData = $this->checkerHelpers->dataSpesialisChecker(["uuid_spesialis" => $uuidDataSpesialis]);
            if (is_null($getData)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'spesialis'), 404]));
            endif;

            /**
             * update data
             */
            $request = collect($request)->except(['_method'])->toArray();
            $updateData = $this->dataSpesialis->where(['uuid_spesialis' => $uuidDataSpesialis])->update($request);
            if (!$updateData) :
                throw new \Exception($this->outputMessage('update fail', $request['spesialis']));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('updated', $request['spesialis']), 200, null);
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
    public function delete($uuidDataSpesialis)
    {
        DB::beginTransaction();
        try {
            /**
             * check data
             */
            $getData = $this->checkerHelpers->dataSpesialisChecker(["uuid_spesialis" => $uuidDataSpesialis]);
            $dataSpesialis = is_null($getData) ? null : $getData->spesialis;
            if (is_null($getData)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'spesialis'), 404]));
            endif;

            /**
             * deleted data
             */
            $delete = $this->dataSpesialis->where('uuid_spesialis', $uuidDataSpesialis)->delete();
            if (!$delete) :
                throw new \Exception($this->outputMessage('undeleted', $dataSpesialis));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('deleted', $dataSpesialis), 200);
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
