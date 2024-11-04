<?php

namespace App\Http\Controllers\API\Web\MasterData\JenisPembayaran;

/**
 * import component
 */

use App\Http\Controllers\Controller;

/**
 * import form request
 */

use App\Http\Requests\MasterData\JenisPembayaran\StoreRequest;
use App\Http\Requests\MasterData\JenisPembayaran\UpdateRequest;

/**
 * import traits
 */

use App\Traits\Message;

/**
 * import repositories
 */

use App\Repositories\MasterData\JenisPembayaran\JenisPembayaranRepositories;
use App\Repositories\Log\LogRepositories;

class JenisPembayaranController extends Controller
{
    use Message;

    private $jenisPembayaranRepositories;
    private $logRepositories;

    public function __construct(
        JenisPembayaranRepositories $jenisPembayaranRepositories,
        LogRepositories $logRepositories
    ) {

        /**
         * initialize repositories
         */
        $this->jenisPembayaranRepositories = $jenisPembayaranRepositories;
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
        $response = $this->jenisPembayaranRepositories->data();
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('all data', 'jenis pembayaran');
        $this->logRepositories->saveLog($log['action'], $log['message'], authAttribute()['id'], null);

        /**
         * response
         */
        return response()->json($response, $code);
    }

    /**
     * get data by uuid tindakan
     */
    public function get($uuidJenisPembayaran)
    {
        /**
         * process to database
         */
        $response = $this->jenisPembayaranRepositories->get($uuidJenisPembayaran);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('single data', 'jenis pembayaran', 'uuid tindakan :' . $uuidJenisPembayaran);
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
        $response = $this->jenisPembayaranRepositories->store($storeRequest);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('save', 'jenis pembayaran ' . $storeRequest['jenis_pembayaran']);
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
        $uuidJenisPembayaran,
        UpdateRequest $updateRequest
    ) {
        /**
         * requesting data
         */
        $updateRequest = $updateRequest->all();

        /**
         * set log 
         */
        $log = $this->outputLogMessage('update', $uuidJenisPembayaran, 'jenis pembayaran ' . $updateRequest['jenis_pembayaran'], 'jenis pembayaran');

        /**
         * process begin
         */
        $response = $this->jenisPembayaranRepositories->update($updateRequest, $uuidJenisPembayaran);
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
    public function delete($uuidJenisPembayaran)
    {
        /**
         * set log
         */
        $log = $this->outputLogMessage('delete', $uuidJenisPembayaran, null, 'jenis pembayaran');

        /**
         * process begin
         */
        $response = $this->jenisPembayaranRepositories->delete($uuidJenisPembayaran);
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
