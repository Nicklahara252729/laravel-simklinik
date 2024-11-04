<?php

namespace App\Repositories\MasterData\Faskes;

/**
 * import component
 */

use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use App\Exceptions\CustomException;
use Illuminate\Support\Carbon;

/**
 * import traits
 */

use App\Traits\Message;
use App\Traits\Response;

/**
 * import models
 */

use App\Models\MasterData\JenisPembayaran\JenisPembayaranLinkFaskes\JenisPembayaranLinkFaskes;
use App\Models\MasterData\Poliklinik\PoliklinikLinkKlinik\PoliklinikLinkKlinik;
use App\Models\MasterData\Poliklinik\Poliklinik\Poliklinik;
use App\Models\MasterData\Faskes\Faskes;
use App\Models\User\User;

/**
 * import helpers
 */

use App\Helpers\CheckerHelpers;

/**
 * import interface
 */

use App\Repositories\MasterData\Faskes\FaskesRepositories;

class EloquentFaskesRepositories implements FaskesRepositories
{
    use Message, Response;

    private $faskes;
    private $path;
    private $poliklinikLinkKlinik;
    private $poliklinik;
    private $jenisPembayaranLinkFaskes;
    private $checkerHelpers;
    private $user;
    private $dateTime;

    public function __construct(
        User $user,
        Faskes $faskes,
        Poliklinik $poliklinik,
        PoliklinikLinkKlinik $poliklinikLinkKlinik,
        JenisPembayaranLinkFaskes $jenisPembayaranLinkFaskes,
        CheckerHelpers $checkerHelpers,
    ) {
        /**
         * initialize model
         */
        $this->user = $user;
        $this->faskes = $faskes;
        $this->poliklinik = $poliklinik;
        $this->poliklinikLinkKlinik = $poliklinikLinkKlinik;
        $this->jenisPembayaranLinkFaskes = $jenisPembayaranLinkFaskes;

        /**
         * initialize helper
         */
        $this->checkerHelpers = $checkerHelpers;

        /**
         * static value
         */
        $this->path = path('faskes');
        $this->dateTime = Carbon::now()->toDateString();
    }

    /**
     * all record
     */
    public function data()
    {
        try {

            /**
             * data faskes
             */
            $data = $this->faskes->select(DB::raw('uuid_faskes,nama,kode,no_faskes,alamat,kode_pos'))->get();
            if (count($data) <= 0) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'faskes'), 404]));
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
    public function get($uuidFaskes)
    {
        try {
            /**
             * get single data
             */
            $getFaskes = $this->checkerHelpers->faskesChecker(["uuid_faskes" => $uuidFaskes]);
            if (is_null($getFaskes)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'faskes'), 404]));
            endif;

            /**
             * get single data poliklinik_link_klinik
             */
            $getData = $this->poliklinikLinkKlinik->where('uuid_faskes', $uuidFaskes)->get('uuid_poliklinik');
            if (count($getData) <= 0) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'poliklinik'), 404]));
            endif;

            /**
             * set logo & poliklinik
             */
            $logo = $getFaskes->logo ?? 'default.png';
            $getFaskes['logo'] = url($this->path . '/' . $logo);
            $getFaskes['poliklinik_link_klinik'] = $getData;

            $response = $this->sendResponse(null, 200, $getFaskes);
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
             * check uploaded file
             */
            $profile_photo_path = null;
            if (isset($request['logo'])) :
                $file = $request['logo'];
                $profile_photo_path = Uuid::uuid4()->getHex() . '.' . $file->extension();
                if (!$file->move(public_path($this->path), $profile_photo_path)) :
                    throw new \Exception($this->outputMessage('directory'));
                endif;
            endif;
            $request['logo'] = $profile_photo_path;

            /**
             * set uuid_poliklinik value
             */
            $uuid_faskes = Uuid::uuid4()->getHex();
            $inputPoliklinikLinkKlinik = [];
            if (isset($request['uuid_poliklinik'])) :
                foreach ($request['uuid_poliklinik'] as $key => $item) :
                    $set = [
                        'uuid_poliklinik' => $item,
                        'uuid_poliklinik_link_klinik' => Uuid::uuid4()->getHex(),
                        'uuid_faskes' => $uuid_faskes,
                        'created_at' => $this->dateTime,
                        'updated_at' => $this->dateTime
                    ];
                    array_push($inputPoliklinikLinkKlinik, $set);
                endforeach;
            endif;

            /**
             * set uuid_jenis_pembayaran value
             */
            $inputJpLinkFaskes = [];
            if (isset($request['uuid_jenis_pembayaran'])) :
                foreach ($request['uuid_jenis_pembayaran'] as $key => $item) :
                    $set = [
                        'uuid_jenis_pembayaran' => $item,
                        'uuid_jp_link_faskes' => Uuid::uuid4()->getHex(),
                        'uuid_faskes' => $uuid_faskes,
                        'created_at' => $this->dateTime,
                        'updated_at' => $this->dateTime
                    ];
                    array_push($inputJpLinkFaskes, $set);
                endforeach;
            endif;

            //save data to tabel jenis_pembayaran_link_faskes
            $saveJenisPembayaran = $this->jenisPembayaranLinkFaskes->insert($inputJpLinkFaskes);
            if (!$saveJenisPembayaran) :
                throw new \Exception($this->outputMessage('unsaved', 'jenis pembayaran'));
            endif;

            //save data to tabel poliklinik_link_klinik
            $savePoli = $this->poliklinikLinkKlinik->insert($inputPoliklinikLinkKlinik);
            if (!$savePoli) :
                throw new \Exception($this->outputMessage('unsaved', 'poli'));
            endif;

            /**
             * save data to tabel faskes
             */
            $inputfaskes = collect($request)->except(['uuid_poliklinik', 'uuid_jenis_pembayaran'])->toArray();
            $inputfaskes['uuid_faskes'] = $uuid_faskes;
            $saveFaskes = $this->faskes->create($inputfaskes);
            if (!$saveFaskes) :
                throw new \Exception($this->outputMessage('unsaved', $request['nama']));
            endif;

            /**
             * save data uuid_faskes to tabel Users
             */
            $inputFaskesUser['uuid_faskes'] = $uuid_faskes;
            $saveFaskesUser = $this->user->where('uuid_user', $request['uuid_user'])->update($inputFaskesUser);
            if (!$saveFaskesUser) :
                throw new \Exception($this->outputMessage('unsaved', $request['nama']));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('saved', $request['nama']), 201, null);
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
    public function update($request, $uuidFaskes)
    {
        DB::beginTransaction();
        try {

            /**
             * validation data
             */
            $getData = $this->checkerHelpers->faskesChecker(["uuid_faskes" => $uuidFaskes]);
            if (is_null($getData)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'faskes'), 404]));
            endif;
            $logo = $getData->logo;

            /**
             * check uploaded file
             */
            $profile_photo_path = null;
            if (isset($request['logo'])) :
                $file = $request['logo'];
                $profile_photo_path = Uuid::uuid4()->getHex() . '.' . $file->extension();

                /**
                 * check file on local storage
                 */
                if (file_exists(public_path($this->path . "/" . $logo)) && !is_null($logo)) :
                    unlink(public_path($this->path . "/" . $logo));
                endif;

                /**
                 * check directoty
                 */
                if (!$file->move(public_path($this->path), $profile_photo_path)) :
                    throw new \Exception($this->outputMessage('directory'));
                endif;
                $request['logo'] = $profile_photo_path;
            endif;

            /**
             * Insert data to tabel poliklinik_link_klinik
             */
            $inputPoliklinikLinkKlinik = [];
            if (isset($request['uuid_poliklinik'])) :
                foreach ($request['uuid_poliklinik'] as $key => $item) :
                    $set = [
                        'uuid_poliklinik' => $item,
                        'uuid_poliklinik_link_klinik' => Uuid::uuid4()->getHex(),
                        'uuid_faskes' => $uuidFaskes,
                        'created_at' => $this->dateTime,
                        'updated_at' => $this->dateTime
                    ];
                    array_push($inputPoliklinikLinkKlinik, $set);
                endforeach;
            endif;

            /**
             * check poliklinik link klinik
             * then delete if exists
             */
            $checkPoliklinikLinkKlinik = $this->checkerHelpers->poliklinikLinkKlinikChecker(['uuid_faskes' => $uuidFaskes]);
            if (!is_null($checkPoliklinikLinkKlinik)) :
                $deleteData = $this->poliklinikLinkKlinik->where('uuid_faskes', $uuidFaskes)->delete();
                if (!$deleteData) :
                    throw new \Exception($this->outputMessage('undeleted', 'poliklinik link klinik'));
                endif;
            endif;

            /**
             * save poliklinik link klinik
             */
            $savePoli = $this->poliklinikLinkKlinik->insert($inputPoliklinikLinkKlinik);
            if (!$savePoli) :
                throw new \Exception($this->outputMessage('unsaved', 'poliklinik link klinik'));
            endif;

            /**
             * Insert data to tabel jenis_pembayaran_link_faskes
             */
            $inputJpLinkFaskes = [];
            if (isset($request['uuid_jenis_pembayaran'])) :
                foreach ($request['uuid_jenis_pembayaran'] as $key => $item) :
                    $set = [
                        'uuid_jenis_pembayaran' => $item,
                        'uuid_jp_link_faskes' => Uuid::uuid4()->getHex(),
                        'uuid_faskes' => $uuidFaskes,
                        'created_at' => $this->dateTime,
                        'updated_at' => $this->dateTime
                    ];
                    array_push($inputJpLinkFaskes, $set);
                endforeach;
            endif;

            /**
             * payment method check
             * then delete if exists
             */
            $checkJpLinkFaskes = $this->checkerHelpers->jenisPembayaranChecker(['uuid_faskes' => $uuidFaskes]);
            if (!is_null($checkJpLinkFaskes)) :
                $deleteDataJp = $this->jenisPembayaranLinkFaskes->where('uuid_faskes', $uuidFaskes)->delete();
                if (!$deleteDataJp) :
                    throw new \Exception($this->outputMessage('undeleted', 'jenis pembayaran link faskes'));
                endif;
            endif;

            /**
             * payment method save
             */
            $saveJP = $this->jenisPembayaranLinkFaskes->insert($inputJpLinkFaskes);
            if (!$saveJP) :
                throw new \Exception($this->outputMessage('unsaved', 'jenis pembayaran link faskes'));
            endif;

            /**
             * update user faskes lama
             */
            $userFaskesLama['uuid_faskes'] = NULL;
            $updateFaskesUserLama = $this->user->where('uuid_faskes', $uuidFaskes)->update($userFaskesLama);
            if (!$updateFaskesUserLama) :
                throw new \Exception($this->outputMessage('update fail', 'user faskes lama'));
            endif;

            /**
             * update user faskes baru
             */
            $inputFaskesUserBaru['uuid_faskes'] = $uuidFaskes;
            $updateFaskesUserBaru = $this->user->where('uuid_user', $request['uuid_user'])->update($inputFaskesUserBaru);
            if (!$updateFaskesUserBaru) :
                throw new \Exception($this->outputMessage('update fail', 'user faskes baru'));
            endif;

            /**
             * update faskes
             */
            $request = collect($request)->except(['_method', 'uuid_poliklinik', 'uuid_jenis_pembayaran'])->toArray();
            $updateFaskes = $this->faskes->where('uuid_faskes', $uuidFaskes)->update($request);
            if (!$updateFaskes) :
                throw new \Exception($this->outputMessage('unsaved', $request['nama']));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('updated', $request['nama']), 200, null);
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
    public function delete($uuidFaskes)
    {
        DB::beginTransaction();
        try {
            /**
             * check data
             */
            $getData = $this->checkerHelpers->faskesChecker(["uuid_faskes" => $uuidFaskes]);
            if (is_null($getData)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'faskes'), 404]));
            endif;
            $faskes = $getData->nama;
            $photoOld = $getData->logo;

            /**
             * deleted data faskes
             */
            $deleteDataFaskes = $this->faskes->where('uuid_faskes', $uuidFaskes)->delete();
            if (!$deleteDataFaskes) :
                throw new \Exception($this->outputMessage('undeleted', $faskes));
            endif;

            /**
             * payment method check
             * then delete if exists
             */
            $checkJpLinkFaskes = $this->checkerHelpers->jenisPembayaranChecker(['uuid_faskes' => $uuidFaskes]);
            if (!is_null($checkJpLinkFaskes)) :
                $deleteDataJp = $this->jenisPembayaranLinkFaskes->where('uuid_faskes', $uuidFaskes)->delete();
                if (!$deleteDataJp) :
                    throw new \Exception($this->outputMessage('undeleted', 'jenis pembayaran link faskes'));
                endif;
            endif;

            /**
             * deleted data Poliklinik link Klinik
             */
            /**
             * check poliklinik link klinik
             * then delete if exists
             */
            $checkPoliklinikLinkKlinik = $this->checkerHelpers->poliklinikLinkKlinikChecker(['uuid_faskes' => $uuidFaskes]);
            if (!is_null($checkPoliklinikLinkKlinik)) :
                $deleteData = $this->poliklinikLinkKlinik->where('uuid_faskes', $uuidFaskes)->delete();
                if (!$deleteData) :
                    throw new \Exception($this->outputMessage('undeleted', 'poliklinik link klinik'));
                endif;
            endif;

            /**
             * update uuid_faskes user menjadi null
             */
            $userFaskesLama['uuid_faskes'] = NULL;
            $updateFaskesUserLama = $this->user->where('uuid_faskes', $uuidFaskes)->update($userFaskesLama);
            if (!$updateFaskesUserLama) :
                throw new \Exception($this->outputMessage('update fail', 'user faskes lama'));
            endif;

            /**
             * remove upload file
             * check file on local storage
             */
            if (file_exists(public_path($this->path . "/" . $photoOld)) && !is_null($photoOld)) :
                unlink(public_path($this->path . "/" . $photoOld));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('deleted', $faskes), 200);
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
