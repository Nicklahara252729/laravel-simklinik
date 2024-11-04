<?php

namespace App\Http\Controllers\API\Web\MasterData\Poli;

/**
 * import component
 */

use App\Http\Controllers\Controller;

/**
 * import form request
 */

use App\Http\Requests\MasterData\Poli\StoreRequest;
use App\Http\Requests\MasterData\Poli\UpdateRequest;

/**
 * import traits
 */

use App\Traits\Message;

/**
 * import repositories
 */

use App\Repositories\MasterData\Poli\PoliRepositories;
use App\Repositories\Log\LogRepositories;

class PoliController extends Controller
{
    use Message;

    private $poliRepositories;
    private $logRepositories;

    public function __construct(
        PoliRepositories $poliRepositories,
        LogRepositories $logRepositories
    ) {

        /**
         * initialize repositories
         */
        $this->poliRepositories = $poliRepositories;
        $this->logRepositories = $logRepositories;
    }

    /**
     * all record data
     */
    public function data()
    {
        /**
         * load data from repositories
         */
        $response = $this->poliRepositories->data();
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('all data', 'poliklinik');
        $this->logRepositories->saveLog($log['action'], $log['message'], authAttribute()['id'], null);

        /**
         * response
         */
        return response()->json($response, $code);
    }

    /**
     * get data by uuid poliklinik
     */
    public function get($uuidPoliklinik)
    {
        /**
         * process to database
         */
        $response = $this->poliRepositories->get($uuidPoliklinik);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('single data', 'poliklinik', 'uuid poliklinik :' . $uuidPoliklinik);
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
        $response = $this->poliRepositories->store($storeRequest);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('save', 'poliklinik ' . $storeRequest['poliklinik']);
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
        $uuidPoliklinik,
        UpdateRequest $updateRequest
    ) {
        /**
         * requesting data
         */
        $updateRequest = $updateRequest->all();

        /**
         * set log 
         */
        $log = $this->outputLogMessage('update', $uuidPoliklinik, 'poliklinik ' . $updateRequest['poliklinik'], 'poliklinik');

        /**
         * process begin
         */
        $response = $this->poliRepositories->update($updateRequest, $uuidPoliklinik);
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
    public function delete($uuidPoliklinik)
    {
        /**
         * set log
         */
        $log = $this->outputLogMessage('delete', $uuidPoliklinik, null, 'poliklinik');

        /**
         * process begin
         */
        $response = $this->poliRepositories->delete($uuidPoliklinik);
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
