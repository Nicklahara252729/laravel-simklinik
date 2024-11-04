<?php

namespace App\Http\Controllers\API\Web\MasterData\TindakanKategori;

/**
 * import component
 */

use App\Http\Controllers\Controller;

/**
 * import form request
 */

use App\Http\Requests\MasterData\TindakanKategori\StoreRequest;
use App\Http\Requests\MasterData\TindakanKategori\UpdateRequest;

/**
 * import traits
 */

use App\Traits\Message;

/**
 * import repositories
 */

use App\Repositories\MasterData\TindakanKategori\TindakanKategoriRepositories;
use App\Repositories\Log\LogRepositories;

class TindakanKategoriController extends Controller
{
    use Message;

    private $tindakanKategoriRepositories;
    private $logRepositories;

    public function __construct(

        TindakanKategoriRepositories $tindakanKategoriRepositories,
        LogRepositories $logRepositories
    ) {

        /**
         * initialize repositories
         */
        $this->tindakanKategoriRepositories = $tindakanKategoriRepositories;
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
        $response = $this->tindakanKategoriRepositories->data($uuidFaskes);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('all data', 'tindakan kategori');
        $this->logRepositories->saveLog($log['action'], $log['message'], authAttribute()['id'], null);

        /**
         * response
         */
        return response()->json($response, $code);
    }

    /**
     * get data by uuid tindakan kategori
     */
    public function get($uuidTindakanKategori)
    {
        /**
         * process to database
         */
        $response = $this->tindakanKategoriRepositories->get($uuidTindakanKategori);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('single data', 'tindakan kategori', 'uuid tindakan kategori :' . $uuidTindakanKategori);
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
        $response = $this->tindakanKategoriRepositories->store($storeRequest);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('save', 'tindakan kategori ' . $storeRequest['kategori']);
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
        $uuidTindakanKategori,
        UpdateRequest $updateRequest
    ) {
        /**
         * requesting data
         */
        $updateRequest = $updateRequest->all();

        /**
         * set log 
         */
        $log = $this->outputLogMessage('update', $uuidTindakanKategori, 'tindakan kategori ' . $updateRequest['kategori'], 'tindakan kategori');

        /**
         * process begin
         */
        $response = $this->tindakanKategoriRepositories->update($updateRequest, $uuidTindakanKategori);
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
    public function delete($uuidTindakanKategori)
    {
        /**
         * set log
         */
        $log = $this->outputLogMessage('delete', $uuidTindakanKategori, null, 'tindakan kategori');

        /**
         * process begin
         */
        $response = $this->tindakanKategoriRepositories->delete($uuidTindakanKategori);
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
