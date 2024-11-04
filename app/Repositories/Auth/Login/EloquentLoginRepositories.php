<?php

namespace App\Repositories\Auth\Login;

/**
 * import collection
 */

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

/**
 * import trait
 */

use App\Traits\Message;
use App\Traits\Response;

/**
 * import repositories
 */

use App\Repositories\Auth\Login\LoginRepositories;
use App\Repositories\Log\LogRepositories;

class EloquentLoginRepositories implements LoginRepositories
{
    use Message, Response;

    private $logRepositories;
    private $path;

    public function __construct(
        LogRepositories $logRepositories
    ) {
        $this->logRepositories = $logRepositories;
        /**
         * static value
         */
        $this->path = path('user');
    }

    /**
     * login
     */
    public function login($request)
    {
        try {
            /**
             * filter input only email, password
             */
            $credentials = $request;
            $token = Auth::attempt($credentials);

            /**
             * create token
             */
            if (!$token) :
                $message = $this->outputLogMessage('login fail', $request['username']);
                $uuidUser = null;
                $response = $this->sendResponse($this->outputMessage('invalid', 'credential'), 401);
            else :
                $token =  Auth::user()->createToken('Passport Access Client');
                $message = $this->outputLogMessage('login success', $request['username']);
                $uuidUser = Auth::user()->uuid_user;
                $response = $this->sendResponse(null, 200, [
                    'token'      => $token->accessToken,
                    'type'       => 'bearer',
                    'expires_in' => $token->token->expires_at->diffInSeconds(Carbon::now())
                ]);
            endif;

            /**
             * save log
             */
            $this->logRepositories->saveLog($message['action'], $message['message'], $uuidUser, null);
        } catch (\Exception $e) {
            $response = $this->sendResponse($e->getMessage(), 500);
        }
        return $response;
    }
}