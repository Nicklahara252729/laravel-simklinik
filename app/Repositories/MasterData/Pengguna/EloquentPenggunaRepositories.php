<?php

namespace App\Repositories\MasterData\Pengguna;

/**
 * import component
 */

use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use App\Exceptions\CustomException;

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

use App\Repositories\MasterData\Pengguna\PenggunaRepositories;
use Illuminate\Database\Eloquent\Collection;

class EloquentPenggunaRepositories implements PenggunaRepositories
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
     * all record
     */
    public function data()
    {
        try {

            /**
             * data pengguna
             */
            $data = $this->user
                ->join('faskes', 'users.uuid_faskes', '=', 'faskes.uuid_faskes')
                ->select(DB::raw('users.uuid_user, users.name, users.username, users.email, users.phone, CASE WHEN users.photo IS NULL THEN "blank.png" ELSE users.photo END as photo, faskes.nama as faskes_name'))
                ->get();

            $output = [];
            foreach ($data as $key => $value) :
                $set = [
                    'uuid_user' => $value->uuid_user,
                    'name'      => $value->name,
                    'username'  => $value->username,
                    'email'     => $value->email,
                    'phone'     => $value->phone,
                    'photo'     => url($this->path . '/' . $value->photo),
                    'faskes_name' => $value->faskes_name
                ];
                array_push($output, $set);
            endforeach;

            if (count($output) <= 0) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'pengguna'), 404]));
            endif;

            $response = $this->sendResponse(null, 200, $output);
        } catch (CustomException $ex) {
            $ex = json_decode($ex->getMessage());
            $response = $this->sendResponse($ex[0], $ex[1]);
        } catch (\Exception $e) {
            $response = $this->sendResponse($e->getMessage(), 500);
        }

        return $response;
    }

    /**
     * get data by uuid
     */
    public function get($uuidUser)
    {
        try {
            /**
             * get single data
             */
            $getUser = $this->checkerHelpers->userChecker(["users.uuid_user" => $uuidUser]);
            if (is_null($getUser)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'pengguna'), 404]));
            endif;

            $data = collect($getUser)->only([
                'name',
                'uuid_user',
                'username',
                'email',
                'phone',
                'level',
                'photo'
            ]);

            $response = $this->sendResponse(null, 200, $data);
        } catch (CustomException $ex) {
            $ex = json_decode($ex->getMessage());
            $response = $this->sendResponse($ex[0], $ex[1]);
        } catch (\Exception $e) {
            $response = $this->sendResponse($e->getMessage(), 500);
        }
        return $response;
    }

    /**
     * store data to db
     */
    public function store($request)
    {
        DB::beginTransaction();
        try {
            /**
             * input for user
             */
            $uuidUser = Uuid::uuid4()->getHex();
            $inputUser = [
                'uuid_user'     => $uuidUser,
                'name'          => $request['name'],
                'email'         => $request['email'],
                'username'      => $request['username'],
                'password'      => bcrypt($request['password']),
                'phone'         => $request['phone'],
            ];

            /**
             * check uploaded file
             */
            $profile_photo_path = null;
            if (isset($request['photo'])) :
                $file = $request['photo'];
                $profile_photo_path = Uuid::uuid4()->getHex() . '.' . $file->extension();
                if (!$file->move(public_path($this->path), $profile_photo_path)) :
                    throw new \Exception($this->outputMessage('directory'));
                endif;
                $inputUser['photo'] = $profile_photo_path;
            endif;

            $saveUser = $this->user->create($inputUser);
            if (!$saveUser) :
                throw new \Exception($this->outputMessage('unsaved', $request['name']));
            endif;


            DB::commit();
            $response = $this->sendResponse($this->outputMessage('saved', $request['name']), 201, null);
        } catch (CustomException $ex) {
            $ex = json_decode($ex->getMessage());
            $response = $this->sendResponse($ex[0], $ex[1]);
        } catch (\Exception $e) {
            DB::rollback();
            $response = $this->sendResponse($e->getMessage(), 500);
        }

        /**
         * send response to controller
         */
        return $response;
    }

    /**
     * update data to db
     */
    public function update($request, $uuidUser)
    {
        DB::beginTransaction();
        try {

            /**
             * validation data
             */
            $getUser = $this->checkerHelpers->userChecker(["users.uuid_user" => $uuidUser]);
            if (is_null($getUser)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'pengguna'), 404]));
            endif;

            /**
             * input for user
             */
            $inputUser = [
                'name'          => $request['name'],
                'email'         => $request['email'],
                'username'      => $request['username'],
                'phone'         => $request['phone'],
            ];

            /**
             * check uploaded file
             */
            if (isset($request['photo'])) :
                $file  = $request['photo'];
                $profile_photo_path = Uuid::uuid4()->getHex() . '.' . $file->extension();

                /**
                 * check file on local storage
                 */
                $photoOld = basename($getUser->photo);
                if (file_exists(public_path($this->path . "/" . $photoOld)) && $photoOld != 'blank.png') :
                    unlink(public_path($this->path . "/" . $photoOld));
                endif;

                /**
                 * check directoty
                 */
                if (!$file->move(public_path($this->path), $profile_photo_path)) :
                    throw new \Exception($this->outputMessage('directory'));
                endif;
                $inputUser['photo'] = $profile_photo_path;
            endif;

            $updateUser = $this->user->where('uuid_user', $uuidUser)->update($inputUser);
            if (!$updateUser) :
                throw new \Exception($this->outputMessage('unsaved', $request['name']));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('updated', $request['name']), 200, null);
        } catch (CustomException $ex) {
            $ex = json_decode($ex->getMessage());
            $response = $this->sendResponse($ex[0], $ex[1]);
        } catch (\Exception $e) {
            DB::rollback();
            $response = $this->sendResponse($e->getMessage(), 500);
        }
        /**
         * send response to controller
         */
        return $response;
    }

    /**
     * delete data from db
     */
    public function delete($uuidUser)
    {
        DB::beginTransaction();
        try {
            /**
             * check data
             */
            $getData = $this->checkerHelpers->userChecker(["uuid_user" => $uuidUser]);
            if (is_null($getData)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'pengguna'), 404]));
            endif;
            $pengguna  = $getData->name;
            $photoOld = basename($getData->photo);

            /**
             * deleted data
             */
            $deleteUser = $this->user->where('uuid_user', $uuidUser)->delete();
            if (!$deleteUser) :
                throw new \Exception($this->outputMessage('undeleted', $pengguna));
            endif;

            /**
             * remove upload file
             * check file on local storage
             */
            if (file_exists(public_path($this->path . "/" . $photoOld)) && $photoOld != 'blank.png') :
                unlink(public_path($this->path . "/" . $photoOld));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('deleted', $pengguna), 200);
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
