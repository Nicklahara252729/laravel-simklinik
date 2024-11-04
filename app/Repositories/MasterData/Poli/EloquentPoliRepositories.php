<?php

namespace App\Repositories\MasterData\Poli;

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

use App\Models\MasterData\Poliklinik\Poliklinik\Poliklinik;
use App\Models\MasterData\Pegawai\PoliklinikLinkUser\PoliklinikLinkUser;

/**
 * import helpers
 */

use App\Helpers\CheckerHelpers;

/**
 * import interface
 */

use App\Repositories\MasterData\Poli\PoliRepositories;

class EloquentPoliRepositories implements PoliRepositories
{
    use Message, Response;

    private $poliklinik;
    private $poliklinikLinkUser;
    private $checkerHelpers;

    public function __construct(
        Poliklinik $poliklinik,
        PoliklinikLinkUser $poliklinikLinkUser,
        CheckerHelpers $checkerHelpers,
    ) {
        /**
         * initialize model
         */
        $this->poliklinik = $poliklinik;
        $this->poliklinikLinkUser = $poliklinikLinkUser;

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
             * data poliklinik
             */
            if (authAttribute()['role'] == 'superadmin') :
                $data = $this->poliklinik->get();
            else :
                if (authAttribute()['role'] == 'perawat') :
                    $data = $this->poliklinikLinkUser->select('poliklinik.*', 'poliklinik_link_klinik.uuid_poliklinik_link_klinik')
                        ->join('poliklinik_link_klinik', 'poliklinik_link_user.uuid_poliklinik_link_klinik', '=', 'poliklinik_link_klinik.uuid_poliklinik_link_klinik')
                        ->join('poliklinik', 'poliklinik_link_klinik.uuid_poliklinik', '=', 'poliklinik.uuid_poliklinik')
                        ->where('uuid_user', authAttribute()['id'])
                        ->get();
                else :
                    $data = $this->poliklinik->select('poliklinik.*', 'uuid_poliklinik_link_klinik')
                        ->join('poliklinik_link_klinik', 'poliklinik.uuid_poliklinik', '=', 'poliklinik_link_klinik.uuid_poliklinik')
                        ->where('poliklinik_link_klinik.uuid_faskes', authAttribute()['id_faskes'])
                        ->get();
                endif;
            endif;
            if (count($data) <= 0) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'poliklinik'), 404]));
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
    public function get($uuidPoliklinik)
    {
        try {
            /**
             * get single data
             */

            $getPoliklinik = $this->checkerHelpers->poliklinikChecker(["uuid_poliklinik" => $uuidPoliklinik]);
            if (is_null($getPoliklinik)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'poliklinik'), 404]));
            endif;

            $response = $this->sendResponse(null, 200, $getPoliklinik);
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
             * save data poliklinik
             */
            $saveData = $this->poliklinik->create($request);
            if (!$saveData) :
                throw new \Exception($this->outputMessage('unsaved', $request['poliklinik']));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('saved', $request['poliklinik']), 201, null);
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
    public function update($request, $uuidPoliklinik)
    {
        DB::beginTransaction();
        try {

            /**
             * validation data
             */
            $getPoliklinik = $this->checkerHelpers->poliklinikChecker(["uuid_poliklinik" => $uuidPoliklinik]);
            if (is_null($getPoliklinik)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'poliklinik'), 404]));
            endif;

            /**
             * update data
             */
            $request = collect($request)->except(['_method'])->toArray();
            $updateData = $this->poliklinik->where(['uuid_poliklinik' => $uuidPoliklinik])->update($request);
            if (!$updateData) :
                throw new \Exception($this->outputMessage('update fail', $request['poliklinik']));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('updated', $request['poliklinik']), 200, null);
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
    public function delete($uuidPoliklinik)
    {
        DB::beginTransaction();
        try {
            /**
             * check data
             */
            $getData = $this->checkerHelpers->poliklinikChecker(["uuid_poliklinik" => $uuidPoliklinik]);
            if (is_null($getData)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'poliklinik'), 404]));
            endif;
            $poliklinik = $getData->poliklinik;

            /**
             * deleted data
             */
            $delete = $this->poliklinik->where('uuid_poliklinik', $uuidPoliklinik)->delete();
            if (!$delete) :
                throw new \Exception($this->outputMessage('undeleted', $poliklinik));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('deleted', $poliklinik), 200);
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
