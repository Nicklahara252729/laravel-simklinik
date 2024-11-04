<?php

namespace App\Http\Controllers\API\Web\MasterData\JadwalPoli;

/**
 * import component
 */

use App\Http\Controllers\Controller;

/**
 * import form request
 */

use App\Http\Requests\MasterData\JadwalPoli\StoreRequest;
use App\Http\Requests\MasterData\JadwalPoli\UpdateRequest;

/**
 * import traits
 */

use App\Traits\Message;

/**
 * import repositories
 */

use App\Repositories\MasterData\JadwalPoli\JadwalPoliRepositories;
use App\Repositories\Log\LogRepositories;

class JadwalPoliController extends Controller
{
    use Message;

    private $jadwalPoliRepositories;
    private $logRepositories;

    public function __construct(
        JadwalPoliRepositories $jadwalPoliRepositories,
        LogRepositories $logRepositories
    ) {

        /**
         * initialize repositories
         */
        $this->jadwalPoliRepositories = $jadwalPoliRepositories;
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
        $response = $this->jadwalPoliRepositories->data($uuidFaskes);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('all data', 'jadwal poli');
        $this->logRepositories->saveLog($log['action'], $log['message'], authAttribute()['id'], null);

        /**
         * response
         */
        return response()->json($response, $code);
    }

    /**
     * get data by uuid jadwal poli
     */
    public function get($uuidJadwalPoli)
    {
        /**
         * process to database
         */
        $response = $this->jadwalPoliRepositories->get($uuidJadwalPoli);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('single data', 'jadwal poli', 'uuid jadwal poli :' . $uuidJadwalPoli);
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
        $response = $this->jadwalPoliRepositories->store($storeRequest);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('save', 'jadwal poli ' . json_encode($storeRequest));
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
        $uuidJadwalPoli,
        UpdateRequest $updateRequest
    ) {
        /**
         * requesting data
         */
        $updateRequest = $updateRequest->all();

        /**
         * set log
         */
        $log = $this->outputLogMessage('update', $uuidJadwalPoli, 'jadwal poli' . json_encode($updateRequest), 'jadwal poli');

        /**
         * process begin
         */
        $response = $this->jadwalPoliRepositories->update($updateRequest, $uuidJadwalPoli);
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
    public function delete($uuidJadwalPoli)
    {
        /**
         * set log
         */
        $log = $this->outputLogMessage('delete', $uuidJadwalPoli, null, 'jadwal poli');

        /**
         * process begin
         */
        $response = $this->jadwalPoliRepositories->delete($uuidJadwalPoli);
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
