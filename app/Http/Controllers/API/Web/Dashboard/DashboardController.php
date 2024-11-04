<?php

namespace App\Http\Controllers\API\Web\Dashboard;

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

use App\Repositories\Dashboard\DashboardRepositories;
use App\Repositories\Log\LogRepositories;

class DashboardController extends Controller
{
    use Message;

    private $dashboardRepositories;
    private $logRepositories;

    public function __construct(
        DashboardRepositories $dashboardRepositories,
        LogRepositories $logRepositories
    ) {

        /**
         * initialize repositories
         */
        $this->dashboardRepositories = $dashboardRepositories;
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
        $response = $this->dashboardRepositories->data($uuidFaskes);
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('all data', 'dashboard');
        $this->logRepositories->saveLog($log['action'], $log['message'], authAttribute()['id'], null);

        /**
         * response
         */
        return response()->json($response, $code);
    }

}
