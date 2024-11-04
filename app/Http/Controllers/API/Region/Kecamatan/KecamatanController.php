<?php

namespace App\Http\Controllers\API\Region\Kecamatan;

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

use App\Repositories\Region\Kecamatan\KecamatanRepositories;
use App\Repositories\Log\LogRepositories;

class KecamatanController extends Controller
{
    use Message;

    protected $kecamatanRepositories;
    private $logRepositories;

    public function __construct(
        KecamatanRepositories $kecamatanRepositories,
        LogRepositories $logRepositories
    ) {
        /**
         * defined repositories
         */
        $this->kecamatanRepositories = $kecamatanRepositories;
        $this->logRepositories = $logRepositories;
    }

    /**
     * get data by id kota
     */
    public function getIdKota($idKota)
    {
        /**
         * load data from repositories
         */
        $response = $this->kecamatanRepositories->getIdKota($idKota);
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
     * get data by id kecamatan
     */
    public function getIdKecamatan($idKecamatan)
    {
        /**
         * load data from repositories
         */
        $response = $this->kecamatanRepositories->getIdKecamatan($idKecamatan);
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
