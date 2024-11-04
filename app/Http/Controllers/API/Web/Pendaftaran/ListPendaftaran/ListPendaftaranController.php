<?php

namespace App\Http\Controllers\API\Web\Pendaftaran\ListPendaftaran;

/**
 * import component
 */

use App\Http\Controllers\Controller;

/**
 * import traits
 */

use App\Traits\Message;

/**
 * import repositories
 */

use App\Repositories\Pendaftaran\ListPendaftaran\ListPendaftaranRepositories;
use App\Repositories\Log\LogRepositories;

class ListPendaftaranController extends Controller
{
    use Message;

    private $listPendaftaranRepositories;
    private $logRepositories;

    public function __construct(
        ListPendaftaranRepositories $listPendaftaranRepositories,
        LogRepositories $logRepositories
    ) {

        /**
         * initialize repositories
         */
        $this->listPendaftaranRepositories = $listPendaftaranRepositories;
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
        $response = $this->listPendaftaranRepositories->data($uuidFaskes);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('all data', 'list pendaftaran');
        $this->logRepositories->saveLog($log['action'], $log['message'], authAttribute()['id'], null);

        /**
         * response
         */
        return response()->json($response, $code);
    }
}
