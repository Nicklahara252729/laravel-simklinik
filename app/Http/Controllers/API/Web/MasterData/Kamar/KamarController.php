<?php

namespace App\Http\Controllers\API\Web\MasterData\Kamar;

/**
 * import component
 */

use App\Http\Controllers\Controller;

/**
 * import form request
 */

use App\Http\Requests\MasterData\Kamar\StoreRequest;
use App\Http\Requests\MasterData\Kamar\StoreBedRequest;
use App\Http\Requests\MasterData\Kamar\UpdateRequest;

/**
 * import traits
 */

use App\Traits\Message;

/**
 * import repositories
 */

use App\Repositories\MasterData\Kamar\KamarRepositories;
use App\Repositories\Log\LogRepositories;

class KamarController extends Controller
{
    use Message;

    private $kamarRepositories;
    private $logRepositories;

    public function __construct(
        KamarRepositories $kamarRepositories,
        LogRepositories $logRepositories
    ) {

        /**
         * initialize repositories
         */
        $this->kamarRepositories = $kamarRepositories;
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
        $response = $this->kamarRepositories->data($uuidFaskes);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('all data', 'kamar');
        $this->logRepositories->saveLog($log['action'], $log['message'], authAttribute()['id'], null);

        /**
         * response
         */
        return response()->json($response, $code);
    }

    /**
     * all record data bed
     */
    public function dataBed($uuidKamar)
    {
        /**
         * load data from repositories
         */
        $response = $this->kamarRepositories->dataBed($uuidKamar);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('all data', 'bed');
        $this->logRepositories->saveLog($log['action'], $log['message'], authAttribute()['id'], null);

        /**
         * response
         */
        return response()->json($response, $code);
    }

    /**
     * get data by uuid kamar
     */
    public function get($uuidKamar)
    {
        /**
         * process to database
         */
        $response = $this->kamarRepositories->get($uuidKamar);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('single data', 'kamar', 'uuid kamar :' . $uuidKamar);
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
        $response = $this->kamarRepositories->store($storeRequest);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('save', 'kamar ' . $storeRequest['nama_kamar']);
        $this->logRepositories->saveLog($log['action'], $log['message'], authAttribute()['id'], null);

        /**
         * response
         */
        return response()->json($response, $code);
    }

    /**
     * store data bed
     */
    public function storeBed(
        StoreBedRequest $storeBedRequest
    ) {
        /**
         * requesting data
         */
        $storeBedRequest = $storeBedRequest->all();

        /**
         * process begin
         */
        $response = $this->kamarRepositories->storeBed($storeBedRequest);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('save', 'data bed');
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
        $uuidKamar,
        UpdateRequest $updateRequest
    ) {
        /**
         * requesting data
         */
        $updateRequest = $updateRequest->all();

        /**
         * set log
         */
        $log = $this->outputLogMessage('update', $uuidKamar, 'kamar ' . $updateRequest['nama_kamar'], 'kamar');

        /**
         * process begin
         */
        $response = $this->kamarRepositories->update($updateRequest, $uuidKamar);
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
    public function delete($uuidKamar)
    {
        /**
         * set log
         */
        $log = $this->outputLogMessage('delete', $uuidKamar, null, 'kamar');

        /**
         * process begin
         */
        $response = $this->kamarRepositories->delete($uuidKamar);
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
     * delete data bed
     */
    public function deleteBed($uuidBed)
    {
        /**
         * set log
         */
        $log = $this->outputLogMessage('delete', $uuidBed, null, 'bed');

        /**
         * process begin
         */
        $response = $this->kamarRepositories->deleteBed($uuidBed);
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
