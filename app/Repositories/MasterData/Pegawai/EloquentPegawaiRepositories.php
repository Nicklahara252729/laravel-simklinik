<?php

namespace App\Repositories\MasterData\Pegawai;

/**
 * import component
 */

use App\Exceptions\CustomException;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

/**
 * import traits
 */

use App\Traits\Message;
use App\Traits\Response;

/**
 * import models
 */

use App\Models\MasterData\Pegawai\Pegawai\Pegawai;
use App\Models\MasterData\Pegawai\PoliklinikLinkUser\PoliklinikLinkUser;
use App\Models\MasterData\Pegawai\KamarLinkUser\KamarLinkUser;
use App\Models\MasterData\Pegawai\RoleLinkUser\RoleLinkUser;
use App\Models\User\User;

/**
 * import helpers
 */

use App\Helpers\CheckerHelpers;

/**
 * import interface
 */

use App\Repositories\MasterData\Pegawai\PegawaiRepositories;

class EloquentPegawaiRepositories implements PegawaiRepositories
{
    use Message, Response;

    private $user;
    private $pegawai;
    private $roleLinkUser;
    private $kamarLinkUser;
    private $poliklinikLinkUser;
    private $path;
    private $checkerHelpers;
    private $dateTime;

    public function __construct(
        User $user,
        Pegawai $pegawai,
        KamarLinkUser $kamarLinkUser,
        PoliklinikLinkUser $poliklinikLinkUser,
        RoleLinkUser $roleLinkUser,
        CheckerHelpers $checkerHelpers,
    ) {
        /**
         * initialize model
         */
        $this->user = $user;
        $this->pegawai = $pegawai;
        $this->kamarLinkUser = $kamarLinkUser;
        $this->poliklinikLinkUser = $poliklinikLinkUser;
        $this->roleLinkUser = $roleLinkUser;

        /**
         * initialize helper
         */
        $this->checkerHelpers = $checkerHelpers;

        /**
         * static value
         */
        $this->path = path('user');
        $this->dateTime = Carbon::now()->toDateString();
    }

    /**
     * where condition
     */
    private function whereCondition($uuidFaskes = null, $uuidUser = null)
    {
        $whereCondition = [
            authAttribute()['role'] == 'superadmin' ? ['users.uuid_faskes' => $uuidFaskes] : ['users.uuid_faskes' => authAttribute()['id_faskes']],
            ['users.uuid_user' => $uuidUser, 'users.uuid_faskes' => authAttribute()['role'] == 'superadmin' ? $uuidFaskes : authAttribute()['id_faskes']],
        ];
        return $whereCondition;
    }

    /**
     * all record
     */
    public function data($uuidFaskes)
    {
        try {

            /**
             * data pegawai
             */
            $data = $this->user->select(
                'users.uuid_user',
                'name',
                'username',
                'email',
                'phone',
                'uuid_faskes',
                'level',
                DB::raw('CASE WHEN photo IS NULL THEN CONCAT("' . url($this->path) . '/", "blank.png") ELSE CONCAT("' . url($this->path) . '/", photo) END AS photo')
            )
                ->join('pegawai', 'users.uuid_user', '=', 'pegawai.uuid_user')
                ->where($this->whereCondition($uuidFaskes)[0])
                ->get();
            if (count($data) <= 0) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'pegawai'), 404]));
            endif;

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
     * get data by uuid
     */
    public function get($uuidUser, $uuidFaskes)
    {
        try {
            /**
             * get single data
             */
            $getUser = $this->checkerHelpers->userChecker($this->whereCondition($uuidFaskes, $uuidUser)[1]);
            if (is_null($getUser)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'user'), 404]));
            endif;

            /**
             * perawat
             */
            if ($getUser->level == 'perawat') :

                /**
                 * get role
                 */
                $getDataRole = $this->roleLinkUser->select(DB::raw('uuid_role_link_user,uuid_role'))
                    ->where('uuid_user', $uuidUser)
                    ->first();
                $getUser['role'] = $getDataRole;

                /**
                 * get kamar
                 */
                $getDataKamar = $this->kamarLinkUser->select(DB::raw('uuid_kamar_link_user,uuid_kamar'))
                    ->where('uuid_user', $uuidUser)
                    ->get();
                if (count($getDataKamar) > 0) :
                    $getUser['kamar'] = $getDataKamar;
                endif;

                /**
                 * get poliklinik
                 */
                $getDataPoliklinik = $this->poliklinikLinkUser->select(DB::raw('uuid_poliklinik_link_user,uuid_poliklinik_link_klinik'))
                    ->where('uuid_user', $uuidUser)
                    ->get();
                if (count($getDataPoliklinik) > 0) :
                    $getUser['poliklinik'] = $getDataPoliklinik;
                endif;
            endif;

            $response = $this->sendResponse(null, 200, $getUser);
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
            $inputUser = collect($request)->only(
                [
                    'name',
                    'email',
                    'username',
                    'level',
                    'phone',
                    'uuid_faskes'
                ]
            )
                ->toArray();
            $inputUser['uuid_user'] = $uuidUser;
            $inputUser['password'] = bcrypt($request['password']);

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

            /**
             * save user
             */
            $saveUser = $this->user->create($inputUser);
            if (!$saveUser) :
                throw new \Exception($this->outputMessage('unsaved', $request['name']));
            endif;

            /**
             * input for pegawai
             */
            $inputPegawai = collect($request)->only(
                [
                    'no_ktp',
                    'no_npwp',
                    'no_str',
                    'tgl_berlaku_str',
                    'tgl_berakhir_str',
                    'no_sip',
                    'tgl_berlaku_sip',
                    'tgl_berakhir_sip',
                    'alamat'
                ]
            )->toArray();
            $inputPegawai['uuid_user'] = $uuidUser;
            $inputPegawai['uuid_spesialis'] = $request['level'] == 'dokter' ? $request['uuid_spesialis'] : null;

            /**
             * save pegawai
             */
            $savePegawai = $this->pegawai->create($inputPegawai);
            if (!$savePegawai) :
                throw new \Exception($this->outputMessage('unsaved', 'pegawai'));
            endif;

            /**
             * input for perawat
             */

            if ($request['level'] == 'perawat') :

                /**
                 * save role link user
                 */
                $inputRoleLink = [
                    'uuid_user' => $uuidUser,
                    'uuid_role' => $request['uuid_role'],
                ];
                $saveRoleLinkUser = $this->roleLinkUser->create($inputRoleLink);
                if (!$saveRoleLinkUser) :
                    throw new \Exception($this->outputMessage('unsaved', 'role link user'));
                endif;

                /**
                 * get data role
                 */
                $getRole = $this->checkerHelpers->roleChecker(['uuid_role' => $request['uuid_role']]);

                /**
                 * save kamar link user
                 */
                if (
                    isset($request['uuid_kamar']) &&
                    !isset($request['uuid_poliklinik_link_klinik']) &&
                    $getRole->menu == 'Management Kamar'
                ) :

                    /**
                     * set value kamar link user
                     */
                    $inputKamarLink = [];
                    foreach ($request['uuid_kamar'] as $key => $item) :
                        $set = [
                            'uuid_kamar_link_user' => Uuid::uuid4()->getHex(),
                            'uuid_user' => $uuidUser,
                            'uuid_kamar' => $item,
                            'created_at' => $this->dateTime,
                            'updated_at' => $this->dateTime
                        ];
                        array_push($inputKamarLink, $set);
                    endforeach;

                    /**
                     * save kamar link user
                     */
                    $saveKamarLink = $this->kamarLinkUser->insert($inputKamarLink);
                    if (!$saveKamarLink) :
                        throw new \Exception($this->outputMessage('unsaved', 'kamar link user'));
                    endif;
                endif;

                /**
                 * save poliklinik link user
                 */
                if (
                    !isset($request['uuid_kamar']) &&
                    isset($request['uuid_poliklinik_link_klinik']) &&
                    $getRole->menu == 'Poliklinik'
                ) :

                    /**
                     * set value poliklinik link user
                     */
                    $inputPoliklinikLink = [];
                    foreach ($request['uuid_poliklinik_link_klinik'] as $key => $item) :
                        $set = [
                            'uuid_poliklinik_link_user' => Uuid::uuid4()->getHex(),
                            'uuid_user' => $uuidUser,
                            'uuid_poliklinik_link_klinik' => $item,
                            'created_at' => $this->dateTime,
                            'updated_at' => $this->dateTime
                        ];
                        array_push($inputPoliklinikLink, $set);
                    endforeach;

                    /**
                     * save poliklink link user
                     */
                    $savePoliklinikLink = $this->poliklinikLinkUser->insert($inputPoliklinikLink);
                    if (!$savePoliklinikLink) :
                        throw new \Exception($this->outputMessage('unsaved', 'poliklinik link user'));
                    endif;
                endif;

                /**
                 * cannot fill both
                 */
                if (isset($request['uuid_kamar']) && isset($request['uuid_poliklinik_link_klinik'])) :
                    throw new \Exception($this->outputMessage('invalid', 'uuid kamar dan uuid poliklinik, harus memilih salah satu'));
                endif;

                /**
                 * cannot empty
                 */
                if (
                    (
                        $getRole->menu == 'Management Kamar' ||
                        $getRole->menu == 'Poliklinik') &&
                    (
                        !isset($request['uuid_kamar']) &&
                        !isset($request['uuid_poliklinik_link_klinik']))
                ) :
                    throw new \Exception($this->outputMessage('invalid', 'uuid kamar atau uuid poliklinik, tidak boleh kosong'));
                endif;

                /**
                 * invalid betweem role and kamar link user
                 */
                if ($getRole->menu == 'Management Kamar' || $getRole->menu == 'Poliklinik') :
                    if (
                        (
                            isset($request['uuid_kamar']) &&
                            !isset($request['uuid_poliklinik_link_klinik']) &&
                            $getRole->menu != 'Management Kamar') ||
                        (
                            !isset($request['uuid_kamar']) &&
                            isset($request['uuid_poliklinik_link_klinik']) &&
                            $getRole->menu != 'Poliklinik'
                        )
                    ) :
                        throw new \Exception($this->outputMessage('invalid', 'role dan link user tidak sesuai'));
                    endif;
                endif;
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
            $getUser = $this->checkerHelpers->userChecker($this->whereCondition(null, $uuidUser)[1]);
            if (is_null($getUser)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'pegawai'), 404]));
            endif;

            /**
             * input for user
             */
            $inputUser = [
                'name' => $request['name'],
                'email' => $request['email'],
                'username' => $request['username'],
                'level' => $request['level'],
                'phone' => $request['phone'],
            ];

            /**
             * check uploaded file
             */
            if (isset($request['photo'])) :
                $file = $request['photo'];
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

            /**
             * processs update uer
             */
            $updateUser = $this->user->where('uuid_user', $uuidUser)->update($inputUser);
            if (!$updateUser) :
                throw new \Exception($this->outputMessage('update fail', $request['name']));
            endif;

            /**
             * input for pegawai
             */
            $inputPegawai = collect($request)->only(
                [
                    'no_ktp',
                    'no_npwp',
                    'no_str',
                    'tgl_berlaku_str',
                    'tgl_berakhir_str',
                    'no_sip',
                    'tgl_berlaku_sip',
                    'tgl_berakhir_sip',
                    'alamat'
                ]
            )->toArray();
            $inputPegawai['uuid_user'] = $uuidUser;
            $inputPegawai['uuid_spesialis'] = $request['level'] == 'dokter' ? $request['uuid_spesialis'] : null;

            /**
             * update data pegawai
             */
            $updatePegawai = $this->pegawai->where('uuid_user', $uuidUser)->update($inputPegawai);
            if (!$updatePegawai) :
                throw new \Exception($this->outputMessage('update fail', 'pegawai'));
            endif;

            /**
             * input for perawat
             */
            if ($request['level'] == 'perawat') :

                /**
                 * check role link user
                 */
                $getRoleLinkUser = $this->checkerHelpers->roleLinkUserChecker(['uuid_user' => $uuidUser]);
                if (is_null($getRoleLinkUser)) :
                    throw new \Exception($this->outputMessage('not found', 'role link user'));
                endif;

                /**
                 * update role link user
                 */
                $updateRoleLinkUser = $this->roleLinkUser->where('uuid_role_link_user', $getRoleLinkUser->uuid_role_link_user)->update(['uuid_role' => $request['uuid_role']]);
                if (!$updateRoleLinkUser) :
                    throw new \Exception($this->outputMessage('update fail', 'role link user'));
                endif;

                /**
                 * get data role
                 */
                $getRole = $this->checkerHelpers->roleChecker(['uuid_role' => $request['uuid_role']]);

                /**
                 * save kamar link user
                 */
                if (
                    isset($request['uuid_kamar']) &&
                    !isset($request['uuid_poliklinik_link_klinik']) &&
                    $getRole->menu == 'Management Kamar'
                ) :

                    /**
                     * check kamar link user
                     * then delete if exists
                     */
                    $getKamarLinkUser = $this->checkerHelpers->kamarLinkUserChecker(['uuid_user' => $uuidUser]);
                    if (!is_null($getKamarLinkUser)) :
                        $deleteKamarLinkUser = $this->kamarLinkUser->where('uuid_user', $uuidUser)->delete();
                        if (!$deleteKamarLinkUser) :
                            throw new \Exception($this->outputMessage('undeleted', 'kamar link user'));
                        endif;
                    endif;

                    /**
                     * set value kamar link user
                     */
                    $inputKamarLink = [];
                    foreach ($request['uuid_kamar'] as $key => $item) :
                        $set = [
                            'uuid_kamar_link_user' => Uuid::uuid4()->getHex(),
                            'uuid_user' => $uuidUser,
                            'uuid_kamar' => $item,
                            'created_at' => $this->dateTime,
                            'updated_at' => $this->dateTime
                        ];
                        array_push($inputKamarLink, $set);
                    endforeach;

                    /**
                     * save kamar link user
                     */
                    $saveKamarLink = $this->kamarLinkUser->insert($inputKamarLink);
                    if (!$saveKamarLink) :
                        throw new \Exception($this->outputMessage('unsaved', 'kamar link user'));
                    endif;
                endif;

                /**
                 * save poliklinik link user
                 */
                if (
                    !isset($request['uuid_kamar']) &&
                    isset($request['uuid_poliklinik_link_klinik']) &&
                    $getRole->menu == 'Poliklinik'
                ) :

                    /**
                     * check poliklinik link user
                     * then delete if exists
                     */
                    $getPoliklinikLinkUser = $this->checkerHelpers->poliklinikLinkUserChecker(['uuid_user' => $uuidUser]);
                    if (!is_null($getPoliklinikLinkUser)) :
                        $deleteKamarPoliklinikLinkUser = $this->poliklinikLinkUser->where('uuid_user', $uuidUser)->delete();
                        if (!$deleteKamarPoliklinikLinkUser) :
                            throw new \Exception($this->outputMessage('undeleted', 'poliklinik link user'));
                        endif;
                    endif;

                    /**
                     * set value poliklinik link user
                     */
                    $inputPoliklinikLink = [];
                    foreach ($request['uuid_poliklinik_link_klinik'] as $key => $item) :
                        $set = [
                            'uuid_poliklinik_link_user' => Uuid::uuid4()->getHex(),
                            'uuid_user' => $uuidUser,
                            'uuid_poliklinik_link_klinik' => $item,
                            'created_at' => $this->dateTime,
                            'updated_at' => $this->dateTime
                        ];
                        array_push($inputPoliklinikLink, $set);
                    endforeach;

                    /**
                     * save poliklink link user
                     */
                    $savePoliklinikLink = $this->poliklinikLinkUser->insert($inputPoliklinikLink);
                    if (!$savePoliklinikLink) :
                        throw new \Exception($this->outputMessage('unsaved', 'poliklinik link user'));
                    endif;
                endif;

                /**
                 * cannot fill both
                 */
                if (isset($request['uuid_kamar']) && isset($request['uuid_poliklinik_link_klinik'])) :
                    throw new \Exception($this->outputMessage('invalid', 'uuid kamar dan uuid poliklinik, harus memilih salah satu'));
                endif;

                /**
                 * cannot empty
                 */
                if (
                    (
                        $getRole->menu == 'Management Kamar' ||
                        $getRole->menu == 'Poliklinik') &&
                    (
                        !isset($request['uuid_kamar']) &&
                        !isset($request['uuid_poliklinik_link_klinik']))
                ) :
                    throw new \Exception($this->outputMessage('invalid', 'uuid kamar atau uuid poliklinik, tidak boleh kosong'));
                endif;

                /**
                 * invalid betweem role and kamar link user
                 */
                if ($getRole->menu == 'Management Kamar' || $getRole->menu == 'Poliklinik') :
                    if (
                        (
                            isset($request['uuid_kamar']) &&
                            !isset($request['uuid_poliklinik_link_klinik']) &&
                            $getRole->menu != 'Management Kamar') ||
                        (
                            !isset($request['uuid_kamar']) &&
                            isset($request['uuid_poliklinik_link_klinik']) &&
                            $getRole->menu != 'Poliklinik'
                        )
                    ) :
                        throw new \Exception($this->outputMessage('invalid', 'role dan link user tidak sesuai'));
                    endif;
                endif;
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
    public function delete($uuidUser, $uuidFaskes)
    {
        DB::beginTransaction();
        try {
            /**
             * check data
             */
            $getData = $this->checkerHelpers->userChecker($this->whereCondition($uuidFaskes, $uuidUser)[1]);
            if (is_null($getData)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'pegawai'), 404]));
            endif;
            $pegawai = $getData->name;
            $photoOld = basename($getData->photo);

            /**
             * check role link 
             * then delete if exists
             */
            $getRoleLinkUser = $this->checkerHelpers->roleLinkUserChecker(['uuid_user' => $uuidUser]);
            if (!is_null($getRoleLinkUser)) :
                $deleteRoleLink = $this->roleLinkUser->where('uuid_user', $uuidUser)->delete();
                if (!$deleteRoleLink) :
                    throw new \Exception($this->outputMessage('undeleted', 'role link user'));
                endif;
            endif;

            /**
             * check kamar link user
             * then delete if exists
             */
            $getKamarLinkUser = $this->checkerHelpers->kamarLinkUserChecker(['uuid_user' => $uuidUser]);
            if (!is_null($getKamarLinkUser)) :
                $deleteKamarLink = $this->kamarLinkUser->where('uuid_user', $uuidUser)->delete();
                if (!$deleteKamarLink) :
                    throw new \Exception($this->outputMessage('undeleted', 'kamar link user'));
                endif;
            endif;

            /**
             * check poliklinik link uesr
             */
            $getPoliklinikLinkUser = $this->checkerHelpers->poliklinikLinkUserChecker(['uuid_user' => $uuidUser]);
            if (!is_null($getPoliklinikLinkUser)) :
                $deletepoliklinikLink = $this->poliklinikLinkUser->where('uuid_user', $uuidUser)->delete();
                if (!$deletepoliklinikLink) :
                    throw new \Exception($this->outputMessage('undeleted', 'poliklinik link user'));
                endif;
            endif;

            /**
             * delete user & oegawai
             */
            $deleteUser = $this->user->where('uuid_user', $uuidUser)->delete();
            $deletePegawai = $this->pegawai->where('uuid_user', $uuidUser)->delete();
            if (!$deleteUser || !$deletePegawai) :
                throw new \Exception($this->outputMessage('undeleted', $pegawai));
            endif;

            /**
             * remove upload file
             * check file on local storage
             */
            if (file_exists(public_path($this->path . "/" . $photoOld)) && $photoOld != 'blank.png') :
                unlink(public_path($this->path . "/" . $photoOld));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('deleted', $pegawai), 200);
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
