<?php

namespace App\Http\Controllers\API\Web\MasterData\SatuanObat;

/**
 * import component
 */

use App\Http\Controllers\Controller;

/**
 * import form request
 */

use App\Http\Requests\MasterData\SatuanObat\StoreRequest;
use App\Http\Requests\MasterData\SatuanObat\UpdateRequest;

/**
 * import traits
 */

use App\Traits\Message;

/**
 * import repositories
 */

use App\Repositories\MasterData\SatuanObat\SatuanObatRepositories;
use App\Repositories\Log\LogRepositories;

class SatuanObatController extends Controller
{
    use Message;

    private $satuanObatRepositories;
    private $logRepositories;

    public function __construct(
        SatuanObatRepositories $satuanObatRepositories,
        LogRepositories $logRepositories
    ) {

        /**
         * initialize repositories
         */
        $this->satuanObatRepositories = $satuanObatRepositories;
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
        $response = $this->satuanObatRepositories->data();
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('all data', 'satuan obat');
        $this->logRepositories->saveLog($log['action'], $log['message'], authAttribute()['id'], null);

        /**
         * response
         */
        return response()->json($response, $code);
    }

    /**
     * get data by uuid satuan obat
     */
    public function get($uuidSatuanObat)
    {
        /**
         * process to database
         */
        $response = $this->satuanObatRepositories->get($uuidSatuanObat);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('single data', 'satuan obat', 'uuid satuan obat :' . $uuidSatuanObat);
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
        $response = $this->satuanObatRepositories->store($storeRequest);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('save', 'satuan obat ' . $storeRequest['satuan']);
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
        $uuidSatuanObat,
        UpdateRequest $updateRequest
    ) {
        /**
         * requesting data
         */
        $updateRequest = $updateRequest->all();

        /**
         * set log
         */
        $log = $this->outputLogMessage('update', $uuidSatuanObat, 'satuan obat' . $updateRequest['satuan'], 'satuan obat');

        /**
         * process begin
         */
        $response = $this->satuanObatRepositories->update($updateRequest, $uuidSatuanObat);
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
    public function delete($uuidSatuanObat)
    {
        /**
         * set log
         */
        $log = $this->outputLogMessage('delete', $uuidSatuanObat, null, 'satuan obat');

        /**
         * process begin
         */
        $response = $this->satuanObatRepositories->delete($uuidSatuanObat);
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
