<?php

namespace App\Http\Controllers\API\Web\MasterData\PetugasPoli;

/**
 * import component
 */

use App\Http\Controllers\Controller;

/**
 * import form request
 */

use App\Http\Requests\MasterData\PetugasPoli\StoreRequest;
use App\Http\Requests\MasterData\PetugasPoli\UpdateRequest;

/**
 * import traits
 */

use App\Traits\Message;

/**
 * import repositories
 */

use App\Repositories\MasterData\PetugasPoli\PetugasPoliRepositories;
use App\Repositories\Log\LogRepositories;

class PetugasPoliController extends Controller
{
    use Message;

    private $petugasPoliRepositories;
    private $logRepositories;

    public function __construct(
        PetugasPoliRepositories $petugasPoliRepositories,
        LogRepositories $logRepositories
    ) {

        /**
         * initialize repositories
         */
        $this->petugasPoliRepositories = $petugasPoliRepositories;
        $this->logRepositories = $logRepositories;
    }

    /**
     * all record data
     */
    public function data($uuidFaskes = null)
    {
        /**
         * load data from repositories
         */
        $response = $this->petugasPoliRepositories->data($uuidFaskes);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('all data', 'petugas poli');
        $this->logRepositories->saveLog($log['action'], $log['message'], authAttribute()['id'], null);

        /**
         * response
         */
        return response()->json($response, $code);
    }

    /**
     * get data by uuid
     */
    public function get($uuidPetugasPoli)
    {
        /**
         * process to database
         */
        $response = $this->petugasPoliRepositories->get($uuidPetugasPoli);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('single data', 'petugas poli', 'uuid Petugas Poli :' . $uuidPetugasPoli);
        $this->logRepositories->saveLog($log['action'], $log['message'], authAttribute()['id'], null);

        /**
         * response
         */
        return response()->json($response, $code);
    }

    /**
     * store data
     */
    public function store(
        StoreRequest $storeRequest
    ) {
        /**
         * requesting data
         */
        $storeRequest = $storeRequest->all();

        /**
         * process begin
         */
        $response = $this->petugasPoliRepositories->store($storeRequest);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('save', 'petugas poli ' . $storeRequest['uuid_user']);
        $this->logRepositories->saveLog($log['action'], $log['message'], authAttribute()['id'], null);

        /**
         * response
         */
        return response()->json($response, $code);
    }

    /**
     * update data
     */
    public function update(
        $uuidPetugasPoli,
        UpdateRequest $updateRequest
    ) {
        /**
         * requesting data
         */
        $updateRequest = $updateRequest->all();

        /**
         * set log
         */
        $log = $this->outputLogMessage('update', $uuidPetugasPoli, 'petugas poli' . $updateRequest['uuid_user'], 'petugas poli');

        /**
         * process begin
         */
        $response = $this->petugasPoliRepositories->update($updateRequest, $uuidPetugasPoli);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $this->logRepositories->saveLog($log['action'], $log['message'], authAttribute()['id'], null);

        /**
         * response
         */
        return response()->json($response, $code);
    }

    /**
     * delete data
     */
    public function delete($uuidPetugasPoli)
    {
        /**
         * set log
         */
        $log = $this->outputLogMessage('delete', $uuidPetugasPoli, null, 'petugas poli');

        /**
         * process begin
         */
        $response = $this->petugasPoliRepositories->delete($uuidPetugasPoli);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $this->logRepositories->saveLog($log['action'], $log['message'], authAttribute()['id'], null);

        /**
         * response
         */
        return response()->json($response, $code);
    }
}
