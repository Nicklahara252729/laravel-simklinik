<?php

namespace App\Http\Controllers\API\Web\MasterData\KlasifikasiObat;

/**
 * import component
 */

use App\Http\Controllers\Controller;

/**
 * import form request
 */

use App\Http\Requests\MasterData\KlasifikasiObat\StoreRequest;
use App\Http\Requests\MasterData\KlasifikasiObat\UpdateRequest;

/**
 * import traits
 */

use App\Traits\Message;

/**
 * import repositories
 */

use App\Repositories\MasterData\KlasifikasiObat\KlasifikasiObatRepositories;
use App\Repositories\Log\LogRepositories;

class KlasifikasiObatController extends Controller
{
    use Message;

    private $klasifikasiObatRepositories;
    private $logRepositories;

    public function __construct(
        KlasifikasiObatRepositories $klasifikasiObatRepositories,
        LogRepositories $logRepositories
    ) {

        /**
         * initialize repositories
         */
        $this->klasifikasiObatRepositories = $klasifikasiObatRepositories;
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
        $response = $this->klasifikasiObatRepositories->data();
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('all data', 'klasifikasi obat');
        $this->logRepositories->saveLog($log['action'], $log['message'], authAttribute()['id'], null);

        /**
         * response
         */
        return response()->json($response, $code);
    }

    /**
     * get data by uuid satuan obat
     */
    public function get($uuidKlasifikasiObat)
    {
        /**
         * process to database
         */
        $response = $this->klasifikasiObatRepositories->get($uuidKlasifikasiObat);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('single data', 'klasifikasi obat', 'uuid klasifikasi obat :' . $uuidKlasifikasiObat);
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
        $response = $this->klasifikasiObatRepositories->store($storeRequest);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('save', 'klasifikasi obat ' . $storeRequest['klasifikasi']);
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
        $uuidKlasifikasiObat,
        UpdateRequest $updateRequest
    ) {
        /**
         * requesting data
         */
        $updateRequest = $updateRequest->all();

        /**
         * set log
         */
        $log = $this->outputLogMessage('update', $uuidKlasifikasiObat, 'klasifikasi obat ' . $updateRequest['klasifikasi'], 'klasifikasi obat');

        /**
         * process begin
         */
        $response = $this->klasifikasiObatRepositories->update($updateRequest, $uuidKlasifikasiObat);
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
    public function delete($uuidKlasifikasiObat)
    {
        /**
         * set log
         */
        $log = $this->outputLogMessage('delete', $uuidKlasifikasiObat, null, 'klasifikasi obat');

        /**
         * process begin
         */
        $response = $this->klasifikasiObatRepositories->delete($uuidKlasifikasiObat);
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
