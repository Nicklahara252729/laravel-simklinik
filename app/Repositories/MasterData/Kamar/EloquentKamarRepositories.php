<?php

namespace App\Repositories\MasterData\Kamar;

/**
 * import component
 */

use Illuminate\Support\Facades\DB;
use App\Exceptions\CustomException;
use Illuminate\Support\Carbon;
use Ramsey\Uuid\Uuid;

/**
 * import traits
 */

use App\Traits\Message;
use App\Traits\Response;

/**
 * import models
 */

use App\Models\MasterData\KamarRawatInap\Bed\Bed;
use App\Models\MasterData\KamarRawatInap\Kamar\Kamar;
use App\Models\MasterData\Pegawai\KamarLinkUser\KamarLinkUser;

/**
 * import helpers
 */

use App\Helpers\CheckerHelpers;

/**
 * import interface
 */

use App\Repositories\MasterData\Kamar\KamarRepositories;

class EloquentKamarRepositories implements KamarRepositories
{
    use Message, Response;

    private $kamar;
    private $bed;
    private $checkerHelpers;
    private $today;
    private $kamarLinkUser;

    public function __construct(
        Kamar $kamar,
        Bed $bed,
        KamarLinkUser $kamarLinkUser,
        CheckerHelpers $checkerHelpers,
    ) {
        /**
         * initialize model
         */
        $this->kamar = $kamar;
        $this->bed = $bed;
        $this->kamarLinkUser = $kamarLinkUser;

        /**
         * initialize helper
         */
        $this->checkerHelpers = $checkerHelpers;

        /**
         * initialize today
         */
        $this->today = Carbon::now();
    }

    /**
     * where condition
     */
    private function whereCondition($uuidFaskes = null, $uuidKamar = null)
    {
        $whereCondition = [
            authAttribute()['role'] == 'superadmin' ? ['kamar.uuid_faskes' => $uuidFaskes] : ['kamar.uuid_faskes' => authAttribute()['id_faskes']],
            authAttribute()['role'] == 'superadmin' ? ['kamar.uuid_kamar' => $uuidKamar] : ['kamar.uuid_kamar' => $uuidKamar, 'kamar.uuid_faskes' => authAttribute()['id_faskes']]
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
             * data kamar
             */
            if (authAttribute()['role'] == 'perawat') :
                $data = $this->kamarLinkUser->select('kamar.uuid_kamar', 'nama_kamar', 'jumlah_bed', 'harga', 'status')
                    ->join('kamar', 'kamar_link_user.uuid_kamar', '=', 'kamar.uuid_kamar')
                    ->where('uuid_user', authAttribute()['id'])
                    ->get();
            else :
                $data = $this->kamar->select('uuid_kamar', 'nama_kamar', 'jumlah_bed', 'harga', 'status')
                    ->where($this->whereCondition($uuidFaskes)[0])
                    ->get();
            endif;
            if (count($data) <= 0) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'kamar'), 404]));
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
     * all record bed
     */
    public function dataBed($uuidKamar)
    {
        try {
            /**
             * data bed
             */
            $data = $this->bed->select('uuid_kamar', 'uuid_bed')->where(['uuid_kamar' => $uuidKamar], [0])->get();
            if (count($data) <= 0) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'bed'), 404]));
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
     * get data by uuid kamar
     */
    public function get($uuidKamar)
    {
        try {
            /**
             * get single data
             */
            $getKamar = $this->checkerHelpers->kamarChecker($this->whereCondition(null, $uuidKamar)[1]);
            if (is_null($getKamar)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'kamar'), 404]));
            endif;
            $response = $this->sendResponse(null, 200, $getKamar);
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
             * save data kamar
             */
            $uuidKamar = Uuid::uuid4()->getHex();
            $request['uuid_kamar'] = $uuidKamar;
            $saveData = $this->kamar->create($request);

            /**
             * save bed
             */
            $inputBed = [];
            for ($i = 0; $i < $request['jumlah_bed']; $i++) :
                $set = [
                    'uuid_kamar' => $uuidKamar,
                    'uuid_bed' => Uuid::uuid4()->getHex(),
                    'created_at' => $this->today,
                    'updated_at' => $this->today,
                ];
                array_push($inputBed, $set);
            endfor;
            $saveBed = $this->bed->insert($inputBed);

            /**
             * if error
             */
            if (!$saveData || !$saveBed) :
                throw new \Exception($this->outputMessage('unsaved', $request['nama_kamar']));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('saved', $request['nama_kamar']), 201, null);
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
     * store data bed to db
     */
    public function storeBed($request)
    {
        DB::beginTransaction();
        try {

            /**
             * save bed
             */
            $saveBed = $this->bed->create($request);
            if (!$saveBed) :
                throw new \Exception($this->outputMessage('unsaved', 'data bed'));
            endif;

            /**
             * update data kamar
             */
            $getKamar = $this->checkerHelpers->kamarChecker(['kamar.uuid_kamar' => $request['uuid_kamar']]);
            $updateKamar = $this->kamar->where('uuid_kamar', $request['uuid_kamar'])->update(['jumlah_bed' => $getKamar->jumlah_bed + 1]);
            if (!$updateKamar) :
                throw new \Exception($this->outputMessage('update fail', 'data kamar'));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('saved', 'data bed'), 201, null);
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
    public function update($request, $uuidKamar)
    {
        DB::beginTransaction();
        try {
            /**
             * validation data
             */
            $getKamar = $this->checkerHelpers->kamarChecker($this->whereCondition(null, $uuidKamar)[1]);
            if (is_null($getKamar)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'kamar'), 404]));
            endif;

            /**
             * update data
             */
            $request = collect($request)->except(['_method'])->toArray();
            $updateKamar = $this->kamar->where(['uuid_kamar' => $uuidKamar])->update($request);
            if (!$updateKamar) :
                throw new \Exception($this->outputMessage('update fail', $request['nama_kamar']));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('updated', $request['nama_kamar']), 200, null);
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
    public function delete($uuidKamar)
    {
        DB::beginTransaction();
        try {
            /**
             * check data
             */
            $getData = $this->checkerHelpers->kamarChecker($this->whereCondition(null, $uuidKamar)[1]);
            if (is_null($getData)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'kamar'), 404]));
            endif;
            $kamar = $getData->nama_kamar;

            /**
             * check bed then delete if exists
             */
            $checkBed = $this->checkerHelpers->bedChecker(['uuid_kamar' => $uuidKamar]);
            if (!is_null($checkBed)) :
                $deleteBed = $this->bed->where('uuid_kamar', $uuidKamar)->delete();
                if (!$deleteBed) :
                    throw new \Exception($this->outputMessage('undeleted', 'bed dari kamar ' . $kamar));
                endif;
            endif;

            /**
             * deleted kamar
             */
            $deleteKamar = $this->kamar->where('uuid_kamar', $uuidKamar)->delete();
            if (!$deleteKamar) :
                throw new \Exception($this->outputMessage('undeleted', $kamar));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('deleted', $kamar), 200);
        } catch (CustomException $ex) {
            $ex = json_decode($ex->getMessage());
            $response = $this->sendResponse($ex[0], $ex[1]);
        } catch (\Exception $e) {
            DB::rollback();
            $response = $this->sendResponse($e->getMessage(), 500);
        }
        return $response;
    }

    /**
     * delete data from db
     */
    public function deleteBed($uuidBed)
    {
        DB::beginTransaction();
        try {
            /**
             * check data
             */
            $getData = $this->checkerHelpers->kamarChecker(["uuid_bed" => $uuidBed]);
            if (is_null($getData)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'bed'), 404]));
            endif;

            /**
             * deleted data
             */
            $deleteBed = $this->bed->where('uuid_bed', $uuidBed)->delete();
            if (!$deleteBed) :
                throw new \Exception($this->outputMessage('undeleted', 'data bed'));
            endif;

            /**
             * update kamar
             */
            $getKamar = $this->checkerHelpers->kamarChecker(['kamar.uuid_kamar' => $getData->uuid_kamar]);
            $updateKamar = $this->kamar->where('uuid_kamar', $getData->uuid_kamar)->update(['jumlah_bed' => $getKamar->jumlah_bed - 1]);
            if (!$updateKamar) :
                throw new \Exception($this->outputMessage('undeleted', 'data bed'));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('deleted', 'data bed'), 200);
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
