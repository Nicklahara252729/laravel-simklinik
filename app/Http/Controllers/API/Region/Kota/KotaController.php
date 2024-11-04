<?php

namespace App\Http\Controllers\API\Region\Kota;

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

use App\Repositories\Region\Kota\KotaRepositories;
use App\Repositories\Log\LogRepositories;

class KotaController extends Controller
{
    use Message;

    private $kotaRepositories;
    private $logRepositories;

    public function __construct(
        KotaRepositories $kotaRepositories,
        LogRepositories $logRepositories
    ) {
        /**
         * defined repositories
         */
        $this->kotaRepositories = $kotaRepositories;
        $this->logRepositories = $logRepositories;
    }

    /**
     * get data by id provinsi
     */
    public function getIdProvinsi($idProvinsi)
    {
        /**
         * load data from repositories
         */
        $response = $this->kotaRepositories->getIdProvinsi($idProvinsi);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('all data', 'kabupaten kota');
        $this->logRepositories->saveLog($log['action'], $log['message'], authAttribute()['id'], null);

        /**
         * render data
         */
        return response()->json($response, $code);
    }

    /**
     * get data by id kota
     */
    public function getIdKota($idKota)
    {
        /**
         * load data from repositories
         */
        $response = $this->kotaRepositories->getIdKota($idKota);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('all data', 'kabupaten kota');
        $this->logRepositories->saveLog($log['action'], $log['message'], authAttribute()['id'], null);

        /**
         * render data
         */
        return response()->json($response, $code);
    }
}
