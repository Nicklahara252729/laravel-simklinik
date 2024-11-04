<?php

namespace App\Http\Controllers\API\Web\ListPasien\SuratKeterangan;

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

use App\Repositories\ListPasien\SuratKeterangan\SuratKeteranganRepositories;
use App\Repositories\Log\LogRepositories;

class SuratKeteranganController extends Controller
{
    use Message;

    private $suratKeteranganRepositories;
    private $logRepositories;

    public function __construct(
        SuratKeteranganRepositories $suratKeteranganRepositories,
        LogRepositories $logRepositories
    ) {

        /**
         * initialize repositories
         */
        $this->suratKeteranganRepositories = $suratKeteranganRepositories;
        $this->logRepositories = $logRepositories;
    }

    /**
     * get data by no rm
     */
    public function get($noRm, $uuidFaskes = null)
    {
        /**
         * process to database
         */
        $response = $this->suratKeteranganRepositories->get($noRm, $uuidFaskes);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('single data', 'surat keterangan sehat', 'No RM :' . $noRm);
        $this->logRepositories->saveLog($log['action'], $log['message'], authAttribute()['id'], null);

        /**
         * response
         */
        return response()->json($response, $code);
    }

}
