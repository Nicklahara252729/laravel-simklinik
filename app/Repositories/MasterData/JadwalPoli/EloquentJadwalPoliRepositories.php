<?php

namespace App\Repositories\MasterData\JadwalPoli;

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
use App\Models\MasterData\JadwalPoli\JadwalPoli;

/**
 * import helpers
 */

use App\Helpers\CheckerHelpers;

/**
 * import interface
 */

use App\Repositories\MasterData\JadwalPoli\JadwalPoliRepositories;

class EloquentJadwalPoliRepositories implements JadwalPoliRepositories
{
    use Message, Response;

    private $jadwalPoli;
    private $checkerHelpers;
    private $days;

    public function __construct(
        JadwalPoli $jadwalPoli,
        CheckerHelpers $checkerHelpers,
    ) {
        /**
         * initialize model
         */
        $this->jadwalPoli = $jadwalPoli;

        /**
         * initialize helper
         */
        $this->checkerHelpers = $checkerHelpers;

        /**
         * static value
         */
        $this->days = daysAttribute();
    }

    /**
     * where condition
     */
    private function whereCondition($uuidFaskes = null, $uuidJadwalPoli = null)
    {
        $whereCondition = [
            authAttribute()['role'] == 'superadmin' ? ['jadwal_poli.uuid_faskes' => $uuidFaskes] : ['jadwal_poli.uuid_faskes' => authAttribute()['id_faskes']],
            authAttribute()['role'] == 'superadmin' ? ['jadwal_poli.uuid_jadwal_poli' => $uuidJadwalPoli] : ['jadwal_poli.uuid_jadwal_poli' => $uuidJadwalPoli, 'jadwal_poli.uuid_faskes' => authAttribute()['id_faskes']]
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
             * data jadwal poli
             */
            $data = [];
            foreach ($this->days as $key => $value) :
                $getJadwalPoli = $this->jadwalPoli->select('uuid_jadwal_poli', 'jam', 'keterangan', 'poliklinik', 'name', 'kode_antrian')
                    ->join('poliklinik', 'poliklinik.uuid_poliklinik', '=', 'jadwal_poli.uuid_poliklinik')
                    ->join('users', 'users.uuid_user', '=', 'jadwal_poli.dokter')
                    ->where('hari', $value)
                    ->where($this->whereCondition($uuidFaskes)[0])
                    ->get();

                $setData['hari'] = $value;
                $setData['data'] = [];
                foreach ($getJadwalPoli as $key => $valueJadwalPoli) :
                    $set = [
                        'uuid_jadwal_poli' => $valueJadwalPoli->uuid_jadwal_poli,
                        'kode_antrian' => $valueJadwalPoli->kode_antrian,
                        'poliklinik' => $valueJadwalPoli->poliklinik,
                        'dokter' => $valueJadwalPoli->name,
                        'jam' => $valueJadwalPoli->jam,
                        'keterangan' => $valueJadwalPoli->keterangan,
                    ];
                    array_push($setData['data'], $set);
                endforeach;
                array_push($data, $setData);
            endforeach;

            if (count($data) <= 0) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'jadwal poli'), 404]));
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
    public function get($uuidJadwalPoli)
    {
        try {
            /**
             * get single data
             */
            $getJadwalPoli = $this->checkerHelpers->jadwalPoliChecker($this->whereCondition(null, $uuidJadwalPoli)[1]);
            if (is_null($getJadwalPoli)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'jadwal poli'), 404]));
            endif;

            $response = $this->sendResponse(null, 200, $getJadwalPoli);
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
            $saveData = $this->jadwalPoli->create($request);
            if (!$saveData) :
                throw new \Exception($this->outputMessage('unsaved', 'jadwal poli'));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('saved', 'jadwal poli'), 201, null);
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
    public function update($request, $uuidJadwalPoli)
    {
        DB::beginTransaction();
        try {

            /**
             * validation data
             */
            $getJadwalPoli = $this->checkerHelpers->jadwalPoliChecker($this->whereCondition(null, $uuidJadwalPoli)[1]);
            if (is_null($getJadwalPoli)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'jadwal poli'), 404]));
            endif;

            /**
             * update data
             */
            $request = collect($request)->except(['uuid_jenis_pembayaran', 'harga_jual', '_method'])->toArray();
            $update = $this->jadwalPoli->where(['uuid_jadwal_poli' => $uuidJadwalPoli])->update($request);
            if (!$update) :
                throw new \Exception($this->outputMessage('update fail', 'jadwal poli'));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('updated', 'jadwal poli'), 200, null);
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
    public function delete($uuidJadwalPoli)
    {
        DB::beginTransaction();
        try {
            /**
             * check data
             */
            $getData = $this->checkerHelpers->jadwalPoliChecker($this->whereCondition(null, $uuidJadwalPoli)[1]);
            if (is_null($getData)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'jadwal poli'), 404]));
            endif;

            /**
             * deleted data
             */
            $delete = $this->jadwalPoli->where('uuid_jadwal_poli', $uuidJadwalPoli)->delete();
            if (!$delete) :
                throw new \Exception($this->outputMessage('undeleted', 'jadwal poli'));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('deleted','jadwal poli'), 200);
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
