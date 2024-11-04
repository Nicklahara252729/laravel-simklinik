<?php

namespace App\Http\Controllers\API\Web\ListPasien\PasienRawatInap;

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

use App\Repositories\ListPasien\PasienRawatInap\PasienRawatInapRepositories;
use App\Repositories\Log\LogRepositories;

class PasienRawatInapController extends Controller
{
    use Message;

    private $pasienRawatInapRepositories;
    private $logRepositories;

    public function __construct(
        PasienRawatInapRepositories $pasienRawatInapRepositories,
        LogRepositories $logRepositories
    ) {

        /**
         * initialize repositories
         */
        $this->pasienRawatInapRepositories = $pasienRawatInapRepositories;
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
        $response = $this->pasienRawatInapRepositories->data($uuidFaskes);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('all data', 'pasien');
        $this->logRepositories->saveLog($log['action'], $log['message'], authAttribute()['id'], null);

        /**
         * response
         */
        return response()->json($response, $code);
    }

    /**
     * get data by uuid
     */
    public function get($uuidPendaftaran, $uuidFaskes = null)
    {
        /**
         * process to database
         */
        $response = $this->pasienRawatInapRepositories->get($uuidPendaftaran, $uuidFaskes);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('single data', 'pasien rawat inap', 'uuid pendaftaran :' . $uuidPendaftaran);
        $this->logRepositories->saveLog($log['action'], $log['message'], authAttribute()['id'], null);

        /**
         * response
         */
        return response()->json($response, $code);
    }

}
