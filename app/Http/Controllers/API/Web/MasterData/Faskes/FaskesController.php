<?php

namespace App\Http\Controllers\API\Web\MasterData\Faskes;

/**
 * import component
 */

use App\Http\Controllers\Controller;

/**
 * import form request
 */

use App\Http\Requests\MasterData\Faskes\StoreRequest;
use App\Http\Requests\MasterData\Faskes\UpdateRequest;

/**
 * import traits
 */

use App\Traits\Message;

/**
 * import repositories
 */

use App\Repositories\MasterData\Faskes\FaskesRepositories;
use App\Repositories\Log\LogRepositories;

class FaskesController extends Controller
{
    use Message;

    private $faskesRepositories;
    private $logRepositories;

    public function __construct(
        FaskesRepositories $faskesRepositories,
        LogRepositories $logRepositories
    ) {

        /**
         * initialize repositories
         */
        $this->faskesRepositories = $faskesRepositories;
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
        $response = $this->faskesRepositories->data();
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('all data', 'faskes');
        $this->logRepositories->saveLog($log['action'], $log['message'], authAttribute()['id'], null);

        /**
         * response
         */
        return response()->json($response, $code);
    }

    /**
     * get data by uuid faskes
     */
    public function get($uuidFaskes)
    {
        /**
         * process to database
         */
        $response = $this->faskesRepositories->get($uuidFaskes);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('single data', 'faskes', 'uuid faskes :' . $uuidFaskes);
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
        $response = $this->faskesRepositories->store($storeRequest);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('save', 'faskes ' . $storeRequest['nama']);
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
        $uuidFaskes,
        UpdateRequest $updateRequest
    ) {
        /**
         * requesting data
         */
        $updateRequest = $updateRequest->all();

        /**
         * set log 
         */
        $log = $this->outputLogMessage('update', $uuidFaskes, 'faskes ' . $updateRequest['nama'], 'faskes');

        /**
         * process begin
         */
        $response = $this->faskesRepositories->update($updateRequest, $uuidFaskes);
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
    public function delete($uuidFaskes)
    {
        /**
         * set log
         */
        $log = $this->outputLogMessage('delete', $uuidFaskes, null, 'faskes');

        /**
         * process begin
         */
        $response = $this->faskesRepositories->delete($uuidFaskes);
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
