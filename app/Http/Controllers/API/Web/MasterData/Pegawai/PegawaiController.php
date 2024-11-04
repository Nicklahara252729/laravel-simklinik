<?php

namespace App\Http\Controllers\API\Web\MasterData\Pegawai;

/**
 * import component
 */

use App\Http\Controllers\Controller;

/**
 * import form request
 */

use App\Http\Requests\MasterData\Pegawai\StoreRequest;
use App\Http\Requests\MasterData\Pegawai\UpdateRequest;

/**
 * import traits
 */

use App\Traits\Message;

/**
 * import repositories
 */

use App\Repositories\MasterData\Pegawai\PegawaiRepositories;
use App\Repositories\Log\LogRepositories;

class PegawaiController extends Controller
{
    use Message;

    private $pegawaiRepositories;
    private $logRepositories;

    public function __construct(
        PegawaiRepositories $pegawaiRepositories,
        LogRepositories $logRepositories
    ) {

        /**
         * initialize repositories
         */
        $this->pegawaiRepositories = $pegawaiRepositories;
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
        $response = $this->pegawaiRepositories->data($uuidFaskes);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('all data', 'pegawai');
        $this->logRepositories->saveLog($log['action'], $log['message'], authAttribute()['id'], null);

        /**
         * response
         */
        return response()->json($response, $code);
    }

    /**
     * get data by uuid user
     */
    public function get($uuidUser, $uuidFaskes = null)
    {
        /**
         * process to database
         */
        $response = $this->pegawaiRepositories->get($uuidUser, $uuidFaskes);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('single data', 'pegawai', 'uuid user :' . $uuidUser);
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
        $response = $this->pegawaiRepositories->store($storeRequest);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('save', 'pegawai ' . $storeRequest['name']);
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
        $uuidUser,
        UpdateRequest $updateRequest
    ) {
        /**
         * requesting data
         */
        $updateRequest = $updateRequest->all();

        /**
         * set log
         */
        $log = $this->outputLogMessage('update', $uuidUser, 'pegawai ' . $updateRequest['name'], 'pegawai');

        /**
         * process begin
         */
        $response = $this->pegawaiRepositories->update($updateRequest, $uuidUser);
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
        
        return $updateRequest;
    }

    /**
     * delete data
     */
    public function delete($uuidUser,$uuidFaskes = null)
    {
        /**
         * set log
         */
        $log = $this->outputLogMessage('delete', $uuidUser, null, 'pegawai');

        /**
         * process begin
         */
        $response = $this->pegawaiRepositories->delete($uuidUser,$uuidFaskes);
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
