<?php

namespace App\Http\Controllers\API\Web\ListPasien\KartuPasien;

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

use App\Repositories\ListPasien\KartuPasien\KartuPasienRepositories;
use App\Repositories\Log\LogRepositories;

class KartuPasienController extends Controller
{
    use Message;

    private $kartuPasienRepositories;
    private $logRepositories;

    public function __construct(
        KartuPasienRepositories $kartuPasienRepositories,
        LogRepositories $logRepositories
    ) {

        /**
         * initialize repositories
         */
        $this->kartuPasienRepositories = $kartuPasienRepositories;
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
        $response = $this->kartuPasienRepositories->get($noRm, $uuidFaskes);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('single data', 'kartu pasien', 'No RM :' . $noRm);
        $this->logRepositories->saveLog($log['action'], $log['message'], authAttribute()['id'], null);

        /**
         * response
         */
        return response()->json($response, $code);
    }

}
