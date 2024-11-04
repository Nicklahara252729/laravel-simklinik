<?php

namespace App\Http\Controllers\API\Web\MasterData\Tindakan;

/**
 * import component
 */

use App\Http\Controllers\Controller;

/**
 * import form request
 */

use App\Http\Requests\MasterData\Tindakan\StoreRequest;
use App\Http\Requests\MasterData\Tindakan\UpdateRequest;

/**
 * import traits
 */

use App\Traits\Message;

/**
 * import repositories
 */

use App\Repositories\MasterData\Tindakan\TindakanRepositories;
use App\Repositories\Log\LogRepositories;

class TindakanController extends Controller
{
    use Message;

    private $tindakanRepositories;
    private $logRepositories;

    public function __construct(
        TindakanRepositories $tindakanRepositories,
        LogRepositories $logRepositories
    ) {

        /**
         * initialize repositories
         */
        $this->tindakanRepositories = $tindakanRepositories;
        $this->logRepositories = $logRepositories;
    }

    /**
     * all record data
     */
    public function data($uuidFaskes = null, $uuidPoliLinkKlinik = null)
    {
        /**
         * load data from repositories
         */
        $response = $this->tindakanRepositories->data($uuidFaskes, $uuidPoliLinkKlinik);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('all data', 'tindakan');
        $this->logRepositories->saveLog($log['action'], $log['message'], authAttribute()['id'], null);

        /**
         * response
         */
        return response()->json($response, $code);
    }

    /**
     * get data by uuid tindakan
     */
    public function get($uuidTindakan)
    {
        /**
         * process to database
         */
        $response = $this->tindakanRepositories->get($uuidTindakan);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('single data', 'tindakan', 'uuid tindakan :' . $uuidTindakan);
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
        $response = $this->tindakanRepositories->store($storeRequest);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('save', 'tindakan ' . $storeRequest['nama']);
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
        $uuidTindakan,
        UpdateRequest $updateRequest
    ) {
        /**
         * requesting data
         */
        $updateRequest = $updateRequest->all();

        /**
         * set log 
         */
        $log = $this->outputLogMessage('update', $uuidTindakan, 'tindakan ' . $updateRequest['nama'], 'tindakan');

        /**
         * process begin
         */
        $response = $this->tindakanRepositories->update($updateRequest, $uuidTindakan);
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
    public function delete($uuidTindakan)
    {
        /**
         * set log
         */
        $log = $this->outputLogMessage('delete', $uuidTindakan, null, 'tindakan');

        /**
         * process begin
         */
        $response = $this->tindakanRepositories->delete($uuidTindakan);
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
