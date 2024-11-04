<?php

namespace App\Repositories\MasterData\JenisPembayaran;

/**
 * import component
 */

use App\Exceptions\CustomException;
use Illuminate\Support\Facades\DB;

/**
 * import traits
 */
use App\Traits\Message;
use App\Traits\Response;

/**
 * import models
 */

use App\Models\MasterData\JenisPembayaran\JenisPembayaran\JenisPembayaran;

/**
 * import helpers
 */

use App\Helpers\CheckerHelpers;

/**
 * import interface
 */

use App\Repositories\MasterData\JenisPembayaran\JenisPembayaranRepositories;

class EloquentJenisPembayaranRepositories implements JenisPembayaranRepositories
{
    use Message, Response;

    private $jenisPembayaran;
    private $checkerHelpers;

    public function __construct(
        JenisPembayaran $jenisPembayaran,
        CheckerHelpers $checkerHelpers,
    ) {
        /**
         * initialize model
         */
        $this->jenisPembayaran = $jenisPembayaran;

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
            if (authAttribute()['role'] == 'superadmin'):
                $data = $this->jenisPembayaran->get();
            else:
                $data = $this->jenisPembayaran->select('jenis_pembayaran.*', 'uuid_jp_link_faskes')
                    ->join('jenis_pembayaran_link_faskes', 'jenis_pembayaran.uuid_jenis_pembayaran', '=', 'jenis_pembayaran_link_faskes.uuid_jenis_pembayaran')
                    ->where('jenis_pembayaran_link_faskes.uuid_faskes', authAttribute()['id_faskes'])
                    ->get();
            endif;

            if (count($data) <= 0):
                throw new CustomException(json_encode([$this->outputMessage('not found', 'jenis pembayaran'), 404]));
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
    public function get($uuidJenisPembayaran)
    {
        try {
            /**
             * get single data
             */

            $getJenisPembayaran = $this->checkerHelpers->jenisPembayaranChecker(["uuid_jenis_pembayaran" => $uuidJenisPembayaran]);
            if (is_null($getJenisPembayaran)):
                throw new CustomException(json_encode([$this->outputMessage('not found', 'jenis pembayaran'), 404]));
            endif;

            $response = $this->sendResponse(null, 200, $getJenisPembayaran);
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
            $saveData = $this->jenisPembayaran->create($request);
            if (!$saveData):
                throw new \Exception($this->outputMessage('unsaved', $request['jenis_pembayaran']));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('saved', $request['jenis_pembayaran']), 201, null);
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
    public function update($request, $uuidJenisPembayaran)
    {
        DB::beginTransaction();
        try {
            /**
             * validation data
             */
            $getJenisPembayaran = $this->checkerHelpers->jenisPembayaranChecker(["uuid_jenis_pembayaran" => $uuidJenisPembayaran]);
            if (is_null($getJenisPembayaran)):
                throw new CustomException(json_encode([$this->outputMessage('not found', 'jenis pembayaran'), 404]));
            endif;

            /**
             * update data
             */
            $request = collect($request)->except(['_method'])->toArray();
            $update = $this->jenisPembayaran->where(['uuid_jenis_pembayaran' => $uuidJenisPembayaran])->update($request);
            $column = isset($request['jenis_pembayaran']) ? $request['jenis_pembayaran'] : $request['is_active'];
            if (!$update):
                throw new \Exception($this->outputMessage('update fail', $column));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('updated', $column), 200, null);
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
    public function delete($uuidJenisPembayaran)
    {
        DB::beginTransaction();
        try {
            /**
             * check data
             */
            $getData = $this->checkerHelpers->jenisPembayaranChecker(["uuid_jenis_pembayaran" => $uuidJenisPembayaran]);
            if (is_null($getData)):
                throw new CustomException(json_encode([$this->outputMessage('not found', 'jenis pembayaran'), 404]));
            endif;
            $jenisPembayaran = $getData->jenis_pembayaran;

            /**
             * deleted data
             */
            $delete = $this->jenisPembayaran->where('uuid_jenis_pembayaran', $uuidJenisPembayaran)->delete();
            if (!$delete):
                throw new \Exception($this->outputMessage('undeleted', $jenisPembayaran));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('deleted', $jenisPembayaran), 200);
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
