<?php

namespace App\Repositories\Auth\Logout;

/**
 * import trait
 */

use App\Traits\Message;
use App\Traits\Response;

/**
 * import collection
 */

use Illuminate\Support\Facades\DB;

/**
 * import repositories
 */

use App\Repositories\Auth\Logout\LogoutRepositories;

class EloquentLogoutRepositories implements LogoutRepositories
{
    use Message, Response;

    public function __construct()
    {
    }

    /**
     * logout
     */
    public function logout()
    {
        DB::beginTransaction();
        try {

            auth()->user()->token()->revoke();

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('logout'), 200, null);
        } catch (\Exception $e) {
            $response = $this->sendResponse($e->getMessage(), 500);
        }
        return $response;
    }
}
