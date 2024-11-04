<?php

namespace App\Repositories\Profil;

/**
 * import component
 */
use Illuminate\Support\Facades\Auth;
use App\Exceptions\CustomException;
use Illuminate\Support\Facades\DB;

/**
 * import traits
 */

use App\Traits\Message;
use App\Traits\Response;

/**
 * import models
 */

use App\Models\User\User;

/**
 * import helpers
 */

use App\Helpers\CheckerHelpers;

/**
 * import interface
 */

use App\Repositories\Profil\ProfilRepositories;

class EloquentProfilRepositories implements ProfilRepositories
{
    use Message, Response;

    private $user;
    private $path;
    private $checkerHelpers;

    public function __construct(
        User $user,
        CheckerHelpers $checkerHelpers,
    ) {
        /**
         * initialize model
         */
        $this->user = $user;

        /**
         * initialize helper
         */
        $this->checkerHelpers = $checkerHelpers;

        /**
         * static value
         */
        $this->path = path('user');
    }

    /**
     * get data
     */
    public function data()
    {
        try {
            /**
             * get data
             */
            $uuidUser = Auth::user()->uuid_user;
            $getData = $this->checkerHelpers->userChecker(['users.uuid_user' => $uuidUser]);
            if (is_null($getData)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'user'), 404]));
            endif;

            $response = $this->sendResponse(null, 200, $getData);
        } catch (CustomException $ex) {
            $ex = json_decode($ex->getMessage());
            $response = $this->sendResponse($ex[0], $ex[1]);
        } catch (\Exception $e) {
            $response = $this->sendResponse($e->getMessage(), 500);
        }
        return $response;
    }

    /**
     * ubah password
     */
    public function resetPassword($request, $uuidUser)
    {
        DB::beginTransaction();
        try {
            /**
             * form setting
             */
            $request = collect($request)->except(['current_password', 'password_confirmation', 'new_password_confirmation'])->toArray();
            $input['password'] = isset($request['password']) ? bcrypt($request['password']) : bcrypt($request['new_password']);

            /**
             * check outlet
             */
            $checkUser = $this->checkerHelpers->userChecker(["users.uuid_user" => $uuidUser]);
            if (is_null($checkUser)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'pengguna'), 404]));
            endif;

            /**
             * update data outlet
             */

            $updatePassword = $this->user->where(["uuid_user" => $uuidUser])->update($input);
            if (!$updatePassword) :
                throw new \Exception($this->outputMessage('update fail', 'password'));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('updated', 'password'), 201, null);
        } catch (CustomException $ex) {
            $ex = json_decode($ex->getMessage());
            $response = $this->sendResponse($ex[0], $ex[1]);
        } catch (\Exception $e) {
            DB::rollback();
            $response = $this->sendResponse($e->getMessage(), 500);
        }
        return $response;
    }
}
