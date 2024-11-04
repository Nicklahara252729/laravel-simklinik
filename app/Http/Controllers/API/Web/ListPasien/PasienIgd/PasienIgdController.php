<?php

namespace App\Http\Controllers\API\Web\ListPasien\PasienIgd;

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

use App\Repositories\ListPasien\PasienIgd\PasienIgdRepositories;
use App\Repositories\Log\LogRepositories;

class PasienIgdController extends Controller
{
    use Message;

    private $pasienIgdRepositories;
    private $logRepositories;

    public function __construct(
        PasienIgdRepositories $pasienIgdRepositories,
        LogRepositories $logRepositories
    ) {

        /**
         * initialize repositories
         */
        $this->pasienIgdRepositories = $pasienIgdRepositories;
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
        $response = $this->pasienIgdRepositories->data($uuidFaskes);
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
        $response = $this->pasienIgdRepositories->get($uuidPendaftaran, $uuidFaskes);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('single data', 'pasien IGD', 'uuid pendaftaran :' . $uuidPendaftaran);
        $this->logRepositories->saveLog($log['action'], $log['message'], authAttribute()['id'], null);

        /**
         * response
         */
        return response()->json($response, $code);
    }

}
