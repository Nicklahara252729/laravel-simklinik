<?php

namespace App\Http\Controllers\API\Region\Desa;

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

use App\Repositories\Region\Desa\DesaRepositories;
use App\Repositories\Log\LogRepositories;

class DesaController extends Controller
{
    use Message; 
    
    protected $desaRepositories;
    private $logRepositories;

    public function __construct(
        DesaRepositories $desaRepositories,
        LogRepositories $logRepositories
    ) {
        /**
         * defined repositories
         */
        $this->desaRepositories = $desaRepositories;
        $this->logRepositories = $logRepositories;
    }

    /**
     * get data by id kecamatan
     */
    public function getIdKecamatan($idKecamatan)
    {
        /**
         * load data from repositories
         */
        $response = $this->desaRepositories->getIdKecamatan($idKecamatan);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('all data', 'tindakan');
        $this->logRepositories->saveLog($log['action'], $log['message'], authAttribute()['id'], null);

        /**
         * render data
         */
        return response()->json($response, $code);
    }

    /**
     * get data by id desa
     */
    public function getIdDesa($idDesa)
    {
        /**
         * load data from repositories
         */
        $response = $this->desaRepositories->getIdDesa($idDesa);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('all data', 'tindakan');
        $this->logRepositories->saveLog($log['action'], $log['message'], authAttribute()['id'], null);

        /**
         * render data
         */
        return response()->json($response, $code);
    }
}
