<?php

namespace App\Http\Controllers\API\Region\Provinsi;

/**
 * import collection
 */

use App\Http\Controllers\Controller;

/**
 * import traits
 */

use App\Traits\Message;

/**
 * import repositories
 */

use App\Repositories\Region\Provinsi\ProvinsiRepositories;
use App\Repositories\Log\LogRepositories;

class ProvinsiController extends Controller
{
    use Message;

    private $logRepositories;
    protected $provinsiRepositories;

    public function __construct(
        ProvinsiRepositories $provinsiRepositories,
        LogRepositories $logRepositories
    ) {
        /**
         * defined repositories
         */
        $this->provinsiRepositories = $provinsiRepositories;
        $this->logRepositories = $logRepositories;
    }

    /**
     * show data provinsi
     */
    public function data()
    {
        /**
         * load data from repositories
         */
        $response = $this->provinsiRepositories->data();
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('all data', 'provinsi');
        $this->logRepositories->saveLog($log['action'], $log['message'], authAttribute()['id'], null);

        /**
         * render data
         */
        return response()->json($response, $code);
    }

    /**
     * get data by name
     */
    public function get($name)
    {
        /**
         * load data from repositories
         */
        $response = $this->provinsiRepositories->get($name);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('all data', 'provinsi');
        $this->logRepositories->saveLog($log['action'], $log['message'], authAttribute()['id'], null);

        /**
         * render data
         */
        return response()->json($response, $code);
    }
}
