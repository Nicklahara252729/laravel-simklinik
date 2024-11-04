<?php

namespace App\Repositories\MasterData\SatuanObat;

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

use App\Models\MasterData\SatuanObat\SatuanObat;

/**
 * import helpers
 */

use App\Helpers\CheckerHelpers;

/**
 * import interface
 */

use App\Repositories\MasterData\SatuanObat\SatuanObatRepositories;

class EloquentSatuanObatRepositories implements SatuanObatRepositories
{
    use Message, Response;

    private $satuanObat;
    private $checkerHelpers;

    public function __construct(
        SatuanObat $satuanObat,
        CheckerHelpers $checkerHelpers,
    ) {
        /**
         * initialize model
         */
        $this->satuanObat = $satuanObat;

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
             * data satuan obat
             */
            $data = $this->satuanObat->get();
            if (count($data) <= 0) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'satuan obat'), 404]));
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
    public function get($uuidSatuanObat)
    {
        try {
            /**
             * get single data
             */
            $getData = $this->checkerHelpers->satuanObatChecker(["uuid_satuan_obat" => $uuidSatuanObat]);
            if (is_null($getData)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'satuan obat'), 404]));
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
            $saveData = $this->satuanObat->create($request);
            if (!$saveData) :
                throw new \Exception($this->outputMessage('unsaved', $request['satuan']));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('saved', $request['satuan']), 201, null);
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
    public function update($request, $uuidSatuanObat)
    {
        DB::beginTransaction();
        try {
            /**
             * validation data
             */
            $getData = $this->checkerHelpers->satuanObatChecker(["uuid_satuan_obat" => $uuidSatuanObat]);
            if (is_null($getData)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'satuan obat'), 404]));
            endif;

            /**
             * update data
             */
            $request = collect($request)->except(['_method'])->toArray();
            $updateSatuanObat = $this->satuanObat->where(['uuid_satuan_obat' => $uuidSatuanObat])->update($request);
            if (!$updateSatuanObat) :
                throw new \Exception($this->outputMessage('update fail', $request['satuan']));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('updated', $request['satuan']), 200, null);
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
    public function delete($uuidSatuanObat)
    {
        DB::beginTransaction();
        try {
            /**
             * check data
             */
            $getData = $this->checkerHelpers->satuanObatChecker(["uuid_satuan_obat" => $uuidSatuanObat]);
            $satuanObat = is_null($getData) ? null : $getData->satuan;
            if (is_null($getData)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'satuan obat'), 404]));
            endif;

            /**
             * deleted data
             */
            $delete = $this->satuanObat->where('uuid_satuan_obat', $uuidSatuanObat)->delete();
            if (!$delete) :
                throw new \Exception($this->outputMessage('undeleted', $satuanObat));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('deleted', $satuanObat), 200);
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
