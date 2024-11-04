<?php

namespace App\Http\Controllers\API\Web\MasterData\Diagnosa;

/**
 * import component
 */

use App\Http\Controllers\Controller;

/**
 * import form request
 */

use App\Http\Requests\MasterData\Diagnosa\StoreRequest;
use App\Http\Requests\MasterData\Diagnosa\UpdateRequest;

/**
 * import traits
 */

use App\Traits\Message;

/**
 * import repositories
 */

use App\Repositories\MasterData\Diagnosa\DiagnosaRepositories;
use App\Repositories\Log\LogRepositories;

class DiagnosaController extends Controller
{
    use Message;

    private $diagnosaRepositories;
    private $logRepositories;

    public function __construct(
        DiagnosaRepositories $diagnosaRepositories,
        LogRepositories $logRepositories
    ) {

        /**
         * initialize repositories
         */
        $this->diagnosaRepositories = $diagnosaRepositories;
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
        $response = $this->diagnosaRepositories->data();
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('all data', 'diagnosa');
        $this->logRepositories->saveLog($log['action'], $log['message'], authAttribute()['id'], null);

        /**
         * response
         */
        return response()->json($response, $code);
    }

    /**
     * get data by code
     */
    public function get($code)
    {
        /**
         * process to database
         */
        $response = $this->diagnosaRepositories->get($code);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('single data', 'diagnosa', 'code :' . $code);
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
        $response = $this->diagnosaRepositories->store($storeRequest);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('save', 'diagnosa ' . $storeRequest['diagnosa']);
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
        $code,
        UpdateRequest $updateRequest
    ) {
        /**
         * requesting data
         */
        $updateRequest = $updateRequest->all();

        /**
         * set log 
         */
        $log = $this->outputLogMessage('update', $code, 'diagnosa ' . $updateRequest['diagnosa'], 'diagnosa');

        /**
         * process begin
         */
        $response = $this->diagnosaRepositories->update($updateRequest, $code);
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
    public function delete($code)
    {
        /**
         * set log
         */
        $log = $this->outputLogMessage('delete', $code, null, 'diagnosa');

        /**
         * process begin
         */
        $response = $this->diagnosaRepositories->delete($code);
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
