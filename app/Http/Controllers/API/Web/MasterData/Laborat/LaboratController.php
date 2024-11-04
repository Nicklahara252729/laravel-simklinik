<?php

namespace App\Http\Controllers\API\Web\MasterData\Laborat;

/**
 * import component
 */

use App\Http\Controllers\Controller;

/**
 * import form request
 */

use App\Http\Requests\MasterData\Laborat\StoreRequest;
use App\Http\Requests\MasterData\Laborat\UpdateRequest;

/**
 * import traits
 */

use App\Traits\Message;

/**
 * import repositories
 */

use App\Repositories\MasterData\Laborat\LaboratRepositories;
use App\Repositories\Log\LogRepositories;

class LaboratController extends Controller
{
    use Message;

    private $laboratRepositories;
    private $logRepositories;

    public function __construct(
        LaboratRepositories $laboratRepositories,
        LogRepositories $logRepositories
    ) {

        /**
         * initialize repositories
         */
        $this->laboratRepositories = $laboratRepositories;
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
        $response = $this->laboratRepositories->data($uuidFaskes);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('all data', 'laborat');
        $this->logRepositories->saveLog($log['action'], $log['message'], authAttribute()['id'], null);

        /**
         * response
         */
        return response()->json($response, $code);
    }

    /**
     * get data by uuid laborat
     */
    public function get($uuidLaborat)
    {
        /**
         * process to database
         */
        $response = $this->laboratRepositories->get($uuidLaborat);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('single data', 'laborat', 'uuid laborat :' . $uuidLaborat);
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
        $response = $this->laboratRepositories->store($storeRequest);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('save', 'laborat ' . $storeRequest['nama']);
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
        $uuidLaborat,
        UpdateRequest $updateRequest
    ) {
        /**
         * requesting data
         */
        $updateRequest = $updateRequest->all();

        /**
         * set log 
         */
        $log = $this->outputLogMessage('update', $uuidLaborat, 'laborat ' . $updateRequest['nama'], 'laborat');

        /**
         * process begin
         */
        $response = $this->laboratRepositories->update($updateRequest, $uuidLaborat);
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
    public function delete($uuidLaborat)
    {
        /**
         * set log
         */
        $log = $this->outputLogMessage('delete', $uuidLaborat, null, 'laborat');

        /**
         * process begin
         */
        $response = $this->laboratRepositories->delete($uuidLaborat);
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
