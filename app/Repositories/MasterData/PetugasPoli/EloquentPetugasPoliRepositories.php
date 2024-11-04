<?php

namespace App\Repositories\MasterData\PetugasPoli;

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

use App\Models\MasterData\PetugasPoli\PetugasPoli;
use App\Models\User\User;

/**
 * import helpers
 */

use App\Helpers\CheckerHelpers;

/**
 * import interface
 */

use App\Repositories\MasterData\PetugasPoli\PetugasPoliRepositories;

class EloquentPetugasPoliRepositories implements PetugasPoliRepositories
{
    use Message, Response;

    private $user;
    private $petugasPoli;
    private $checkerHelpers;

    public function __construct(
        User $user,
        PetugasPoli $petugasPoli,
        CheckerHelpers $checkerHelpers,
    ) {
        /**
         * initialize model
         */
        $this->user = $user;
        $this->petugasPoli = $petugasPoli;

        /**
         * initialize helper
         */
        $this->checkerHelpers = $checkerHelpers;
    }

    /**
     * where condition
     */
    private function whereCondition($uuidFaskes = null, $uuidPetugasPoli = null)
    {
        $whereCondition = [
            authAttribute()['role'] == 'superadmin' ? ['petugas_poli.uuid_faskes' => $uuidFaskes] : ['petugas_poli.uuid_faskes' => authAttribute()['id_faskes']],
            authAttribute()['role'] == 'superadmin' ? ['petugas_poli.uuid_petugas_poli' => $uuidPetugasPoli] : ['petugas_poli.uuid_petugas_poli' => $uuidPetugasPoli, 'petugas_poli.uuid_faskes' => authAttribute()['id_faskes']]
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
             * data petugas poli
             */
            $data = $this->petugasPoli->join('users', 'users.uuid_user', '=', 'petugas_poli.uuid_user')
                ->join('poliklinik', 'poliklinik.uuid_poliklinik', '=', 'petugas_poli.uuid_poliklinik')
                ->select(
                    'uuid_petugas_poli',
                    'users.name',
                    'poliklinik.poliklinik',
                    'petugas_poli.sync_bpjs',
                    'petugas_poli.sync_satu_sehat',
                )
                ->where($this->whereCondition($uuidFaskes)[0])
                ->get();
            if (count($data) <= 0) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'petugas poli'), 404]));
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
    public function get($uuidPetugasPoli)
    {
        try {
            /**
             * get single data
             */
            $getData = $this->petugasPoli->join('users', 'users.uuid_user', '=', 'petugas_poli.uuid_user')
                ->join('poliklinik', 'poliklinik.uuid_poliklinik', '=', 'petugas_poli.uuid_poliklinik')
                ->select(
                    'petugas_poli.uuid_petugas_poli',
                    'users.uuid_user',
                    'poliklinik.uuid_poliklinik',
                    'petugas_poli.sync_bpjs',
                    'petugas_poli.sync_satu_sehat'
                )
                ->where($this->whereCondition(null, $uuidPetugasPoli)[1])
                ->get();
            if (is_null($getData)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'petugas poli'), 404]));
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
             * input for user
             */
            $saveData = $this->petugasPoli->create($request);
            if (!$saveData) :
                throw new \Exception($this->outputMessage('unsaved', 'Petugas Poli'));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('saved', 'Petugas Poli'), 201, null);
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
    public function update($request, $uuidPetugasPoli)
    {
        DB::beginTransaction();
        try {

            /**
             * validation data
             */
            $getData = $this->checkerHelpers->petugasPoliChecker($this->whereCondition(null, $uuidPetugasPoli)[1]);
            if (is_null($getData)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'Petugas Poli'), 404]));
            endif;

            $request = collect($request)->except(['_method'])->toArray();
            $updatePetugas = $this->petugasPoli->where('uuid_petugas_poli', $uuidPetugasPoli)->update($request);
            if (!$updatePetugas) :
                throw new \Exception($this->outputMessage('unsaved', 'Petugas Poli'));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('updated', 'Petugas Poli'), 200, null);
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
    public function delete($uuidPetugasPoli)
    {
        DB::beginTransaction();
        try {
            /**
             * check data 
             */
            $getData = $this->checkerHelpers->petugasPoliChecker($this->whereCondition(null, $uuidPetugasPoli)[1]);
            if (is_null($getData)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'petugas poli'), 404]));
            endif;

            /**
             * deleted data
             */
            $petugas = $getData->name;
            $deletePetugas = $this->petugasPoli->where('uuid_petugas_poli', $uuidPetugasPoli)->delete();
            if (!$deletePetugas) :
                throw new \Exception($this->outputMessage('undeleted', $petugas));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('deleted', $petugas), 200);
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
