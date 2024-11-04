<?php

namespace App\Http\Controllers\API\Web\MasterData\LaboratKategori;

/**
 * import component
 */

use App\Http\Controllers\Controller;

/**
 * import form request
 */

use App\Http\Requests\MasterData\LaboratKategori\StoreRequest;
use App\Http\Requests\MasterData\LaboratKategori\UpdateRequest;

/**
 * import traits
 */

use App\Traits\Message;

/**
 * import repositories
 */

use App\Repositories\MasterData\LaboratKategori\LaboratKategoriRepositories;
use App\Repositories\Log\LogRepositories;

class LaboratKategoriController extends Controller
{
    use Message;

    private $laboratKategoriRepositories;
    private $logRepositories;

    public function __construct(
        LaboratKategoriRepositories $laboratKategoriRepositories,
        LogRepositories $logRepositories
    ) {

        /**
         * initialize repositories
         */
        $this->laboratKategoriRepositories = $laboratKategoriRepositories;
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
        $response = $this->laboratKategoriRepositories->data($uuidFaskes);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('all data', 'laborat kategori');
        $this->logRepositories->saveLog($log['action'], $log['message'], authAttribute()['id'], null);

        /**
         * response
         */
        return response()->json($response, $code);
    }

    /**
     * get data by uuid laborat kategori
     */
    public function get($uuidLaboratKategori)
    {
        /**
         * process to database
         */
        $response = $this->laboratKategoriRepositories->get($uuidLaboratKategori);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('single data', 'laborat kategori', 'uuid laborat kategori :' . $uuidLaboratKategori);
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
        $response = $this->laboratKategoriRepositories->store($storeRequest);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('save', 'laborat kategori ' . $storeRequest['kategori']);
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
        $uuidLaboratKategori,
        UpdateRequest $updateRequest
    ) {
        /**
         * requesting data
         */
        $updateRequest = $updateRequest->all();

        /**
         * set log
         */
        $log = $this->outputLogMessage('update', $uuidLaboratKategori, 'laborat kategori ' . $updateRequest['kategori'], 'laborat kategori');

        /**
         * process begin
         */
        $response = $this->laboratKategoriRepositories->update($updateRequest, $uuidLaboratKategori);
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
    public function delete($uuidLaboratKategori)
    {
        /**
         * set log
         */
        $log = $this->outputLogMessage('delete', $uuidLaboratKategori, null, 'laborat kategori');

        /**
         * process begin
         */
        $response = $this->laboratKategoriRepositories->delete($uuidLaboratKategori);
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
