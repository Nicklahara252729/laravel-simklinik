<?php

namespace App\Http\Middleware;

/**
 * import component
 */

use Closure;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

/**
 * import trait
 */

use App\Traits\Message;
use App\Traits\Response;

/**
 * import helpers
 */

use App\Helpers\CheckerHelpers;

class Signature
{
    use Message, Response;

    private $checkerHelpers;

    public function __construct(
        CheckerHelpers $checkerHelpers
    ) {

        /**
         * initialize helper
         */
        $this->checkerHelpers = $checkerHelpers;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $signature = Auth::user()->uuid_user;
        $checkUser = $this->checkerHelpers->userChecker(['uuid_user' => $signature]);

        if (is_null($checkUser)) :
            $response = $this->sendResponse($this->outputMessage('invalid', 'signature'), 401);
            $code = $response['code'];
            unset($response['code']);
            return response($response, $code);
        endif;

        return $next($request);
    }
}
