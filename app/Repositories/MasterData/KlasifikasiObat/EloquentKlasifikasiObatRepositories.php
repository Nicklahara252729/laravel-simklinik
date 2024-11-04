<?php

namespace App\Repositories\MasterData\KlasifikasiObat;

/**
 * import component
 */

use Illuminate\Support\Facades\DB;
use App\Exceptions\CustomException;

/**
 * import traits
 */

use App\Models\MasterData\KlasifikasiObat\KlasifikasiObat;

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

use App\Repositories\MasterData\KlasifikasiObat\KlasifikasiObatRepositories;

class EloquentKlasifikasiObatRepositories implements KlasifikasiObatRepositories
{
    use Message, Response;

    private $klasifikasiObat;
    private $checkerHelpers;

    public function __construct(
        KlasifikasiObat $klasifikasiObat,
        CheckerHelpers $checkerHelpers,
    ) {
        /**
         * initialize model
         */
        $this->klasifikasiObat = $klasifikasiObat;

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
             * data klasifikasi obat
             */
            $data = $this->klasifikasiObat->get();
            if (count($data) <= 0) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'klasifikasi obat'), 404]));
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
    public function get($uuidKlasifikasiObat)
    {
        try {
            /**
             * get single data
             */
            $getData = $this->checkerHelpers->klasifikasiObatChecker(["uuid_klasifikasi_obat" => $uuidKlasifikasiObat]);
            if (is_null($getData)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'klasifikasi obat'), 404]));
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
            $saveData = $this->klasifikasiObat->create($request);
            if (!$saveData) :
                throw new \Exception($this->outputMessage('unsaved', $request['klasifikasi']));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('saved', $request['klasifikasi']), 201, null);
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
    public function update($request, $uuidKlasifikasiObat)
    {
        DB::beginTransaction();
        try {
            /**
             * validation data
             */
            $getData = $this->checkerHelpers->klasifikasiObatChecker(["uuid_klasifikasi_obat" => $uuidKlasifikasiObat]);
            if (is_null($getData)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'klasifikasi obat'), 404]));
            endif;

            /**
             * update data
             */
            $request = collect($request)->except(['_method'])->toArray();
            $updateKlasifikasiObat = $this->klasifikasiObat->where(['uuid_klasifikasi_obat' => $uuidKlasifikasiObat])->update($request);
            if (!$updateKlasifikasiObat) :
                throw new \Exception($this->outputMessage('update fail', $request['klasifikasi']));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('updated', $request['klasifikasi']), 200, null);
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
    public function delete($uuidKlasifikasiObat)
    {
        DB::beginTransaction();
        try {
            /**
             * check data
             */
            $getData = $this->checkerHelpers->klasifikasiObatChecker(["uuid_klasifikasi_obat" => $uuidKlasifikasiObat]);
            if (is_null($getData)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'klasifikasi obat'), 404]));
            endif;
            $klasifikasiObat = $getData->klasifikasi;

            /**
             * deleted data
             */
            $delete = $this->klasifikasiObat->where('uuid_klasifikasi_obat', $uuidKlasifikasiObat)->delete();
            if (!$delete) :
                throw new \Exception($this->outputMessage('undeleted', $klasifikasiObat));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('deleted', $klasifikasiObat), 200);
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
