<?php

namespace App\Http\Controllers\API\Web\MasterData\DataObat;

/**
 * import component
 */

use App\Http\Controllers\Controller;

/**
 * import form request
 */

use App\Http\Requests\MasterData\DataObat\StoreRequest;
use App\Http\Requests\MasterData\DataObat\UpdateRequest;
use App\Http\Requests\MasterData\DataObat\UpdateStatusRequest;

/**
 * import traits
 */

use App\Traits\Message;

/**
 * import repositories
 */

use App\Repositories\MasterData\DataObat\DataObatRepositories;
use App\Repositories\Log\LogRepositories;

class DataObatController extends Controller
{
    use Message;

    private $dataObatRepositories;
    private $logRepositories;

    public function __construct(
        DataObatRepositories $dataObatRepositories,
        LogRepositories $logRepositories
    ) {

        /**
         * initialize repositories
         */
        $this->dataObatRepositories = $dataObatRepositories;
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
        $response = $this->dataObatRepositories->data($uuidFaskes);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('all data', 'data obat');
        $this->logRepositories->saveLog($log['action'], $log['message'], authAttribute()['id'], null);

        /**
         * response
         */
        return response()->json($response, $code);
    }

    /**
     * get data by uuid data obat
     */
    public function get($uuidDataObat)
    {
        /**
         * process to database
         */
        $response = $this->dataObatRepositories->get($uuidDataObat);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('single data', 'data obat', 'uuid data obat :' . $uuidDataObat);
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
        $response = $this->dataObatRepositories->store($storeRequest);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('save', 'data obat ' . json_encode($storeRequest));
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
        $uuidDataObat,
        UpdateRequest $updateRequest
    ) {
        /**
         * requesting data
         */
        $updateRequest = $updateRequest->all();

        /**
         * set log
         */
        $log = $this->outputLogMessage('update', $uuidDataObat, 'data obat' . json_encode($updateRequest), 'data obat');

        /**
         * process begin
         */
        $response = $this->dataObatRepositories->update($updateRequest, $uuidDataObat);
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
     * update status
     */
    public function updateStatus(
        $uuidDataObat,
        UpdateStatusRequest $updateRequest
    ) {
        /**
         * requesting data
         */
        $updateRequest = $updateRequest->all();

        /**
         * set log
         */
        $log = $this->outputLogMessage('update', $uuidDataObat, 'status obat ' . $updateRequest['status'], 'data obat');

        /**
         * process begin
         */
        $response = $this->dataObatRepositories->update($updateRequest, $uuidDataObat);
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
    public function delete($uuidDataObat)
    {
        /**
         * set log
         */
        $log = $this->outputLogMessage('delete', $uuidDataObat, null, 'data obat');

        /**
         * process begin
         */
        $response = $this->dataObatRepositories->delete($uuidDataObat);
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
