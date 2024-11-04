<?php

namespace App\Http\Controllers\API\Profil\Profil;

/**
 * import component
 */

use App\Http\Controllers\Controller;

/**
 * import traits
 */

use App\Traits\Message;

/**
 * import request
 */

use App\Http\Requests\Profil\ResetPasswordRequest;

/**
 * import repositories
 */

use App\Repositories\Profil\ProfilRepositories;
use App\Repositories\Log\LogRepositories;

class ProfilController extends Controller
{
    use Message;

    private $profilRepositories;
    private $logRepositories;

    public function __construct(
        ProfilRepositories $profilRepositories,
        LogRepositories $logRepositories
    ) {

        /**
         * initialize repositories
         */
        $this->profilRepositories = $profilRepositories;
        $this->logRepositories = $logRepositories;
    }

    /**
     * get data profil
     */
    public function data()
    {
        /**
         * process to database
         */
        $response = $this->profilRepositories->data();
        $code = $response['code'];
        unset($response['code']);

        /**
         * save log
         */
        $log = $this->outputLogMessage('single data', 'profil');
        $this->logRepositories->saveLog($log['action'], $log['message'], authAttribute()['id'], null);

        /**
         * response
         */
        return response()->json($response, $code);
    }

    /**
     * reset password
     */
    public function resetPassword(ResetPasswordRequest $resetPasswordRequest) {
        /**
         * set log 
         */
        $uuidUser = authAttribute()['id'];
        $log = $this->outputLogMessage('change password', $uuidUser);

        $response  = $this->profilRepositories->resetPassword(
            $resetPasswordRequest->validated(),
            $uuidUser
        );

        /**
         * save log
         */
        $this->logRepositories->saveLog($log['action'], $log['message'], authAttribute()['id'], null);

        return response()->json($response);
    }
}
