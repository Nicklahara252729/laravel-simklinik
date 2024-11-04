<?php

namespace App\Http\Controllers\API\Web\MasterData\DataSpesialis;

/**
 * import component
 */

use App\Http\Controllers\Controller;

/**
 * import form request
 */

use App\Http\Requests\MasterData\DataSpesialis\StoreRequest;
use App\Http\Requests\MasterData\DataSpesialis\UpdateRequest;

/**
 * import traits
 */

use App\Traits\Message;

/**
 * import repositories
 */

use App\Repositories\MasterData\DataSpesialis\DataSpesialisRepositories;
use App\Repositories\Log\LogRepositories;

class DataSpesialisController extends Controller
{
    use Message;

    private $dataSpesialisRepositories;
    private $logRepositories;

    public function __construct(
        DataSpesialisRepositories $dataSpesialisRepositories,
        LogRepositories $logRepositories
    ) {

        /**
         * initialize repositories
         */
        $this->dataSpesialisRepositories = $dataSpesialisRepositories;
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
        $response = $this->dataSpesialisRepositories->data();
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('all data', 'spesialis');
        $this->logRepositories->saveLog($log['action'], $log['message'], authAttribute()['id'], null);

        /**
         * response
         */
        return response()->json($response, $code);
    }

    /**
     * get data by uuid
     */
    public function get($uuidDataSpesialis)
    {
        /**
         * process to database
         */
        $response = $this->dataSpesialisRepositories->get($uuidDataSpesialis);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('single data', 'spesialis', 'uuid spesialis :' . $uuidDataSpesialis);
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
        $response = $this->dataSpesialisRepositories->store($storeRequest);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('save', 'spesialis ' . $storeRequest['spesialis']);
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
        $uuidDataSpesialis,
        UpdateRequest $updateRequest
    ) {
        /**
         * requesting data
         */
        $updateRequest = $updateRequest->all();

        /**
         * set log
         */
        $log = $this->outputLogMessage('update', $uuidDataSpesialis, 'spesialis' . $updateRequest['spesialis'], 'spesialis');

        /**
         * process begin
         */
        $response = $this->dataSpesialisRepositories->update($updateRequest, $uuidDataSpesialis);
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
    public function delete($uuidDataSpesialis)
    {
        /**
         * set log
         */
        $log = $this->outputLogMessage('delete', $uuidDataSpesialis, null, 'spesialis');

        /**
         * process begin
         */
        $response = $this->dataSpesialisRepositories->delete($uuidDataSpesialis);
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
