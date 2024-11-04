<?php

namespace App\Repositories\Pendaftaran\PendaftaranPasien;

/**
 * import component
 */

use Illuminate\Support\Facades\DB;
use App\Exceptions\CustomException;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Carbon;

/**
 * import traits
 */

use App\Traits\Response;
use App\Traits\Message;
use App\Traits\Generator;

/**
 * import models
 */

use App\Models\Pendaftaran\DataPendukung\DataPendukung;
use App\Models\Pendaftaran\DataPenanggungJawab\DataPenanggungJawab;
use App\Models\Pendaftaran\DataPribadi\DataPribadi;
use App\Models\Pendaftaran\Pendaftaran\Pendaftaran;
use App\Models\MasterData\KamarRawatInap\Bed\Bed;
use App\Models\Pendaftaran\HistoryBed\HistoryBed;

/**
 * import helpers
 */

use App\Helpers\CheckerHelpers;


/**
 * import interface
 */

use App\Repositories\Pendaftaran\PendaftaranPasien\PendaftaranPasienRepositories;

class EloquentPendaftaranPasienRepositories implements PendaftaranPasienRepositories
{
    use Message, Response, Generator;

    private $pendaftaran;
    private $dataPenanggungJawab;
    private $dataPendukung;
    private $dataPribadi;
    private $checkerHelpers;
    private $date;
    private $bed;
    private $historyBed;

    public function __construct(
        Pendaftaran $pendaftaran,
        DataPribadi $dataPribadi,
        DataPendukung $dataPendukung,
        DataPenanggungJawab $dataPenanggungJawab,
        Bed $bed,
        CheckerHelpers $checkerHelpers,
        Historybed $historyBed
    ) {
        /**
         * initialize model
         */
        $this->pendaftaran = $pendaftaran;
        $this->dataPenanggungJawab = $dataPenanggungJawab;
        $this->dataPendukung = $dataPendukung;
        $this->dataPribadi = $dataPribadi;
        $this->bed = $bed;
        $this->historyBed = $historyBed;

        /**
         * initialize helper
         */
        $this->checkerHelpers = $checkerHelpers;

        /**
         * static value
         */
        $this->date = Carbon::now();
    }

    /**
     * get data by no rm
     */
    public function get($noRm)
    {
        try {
            /**
             * get single data
             */
            $getData = $this->checkerHelpers->pasienChecker(['no_rm' => $noRm]);
            if (is_null($getData)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'data pasien'), 404]));
            endif;

            /**
             * data pribadi
             */
            $data = collect($getData)->except([
                'uuid_data_pj',
                'nama_pj',
                'no_hp',
                'id_provinsi',
                'id_kabupaten',
                'id_kecamatan',
                'id_desa'
            ])->toArray();

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
     * store data to db pasien baru rawat jalan
     */
    public function storePasienBaruRawatJalan($request)
    {
        DB::beginTransaction();
        try {
            $uuidDataPribadi = Uuid::uuid4()->getHex();
            $uuidPendaftaran = Uuid::uuid4()->getHex();
            $noRm = $this->nomorRekamMedis();

            /**
             * save data pribadi
             */
            $inputDataPribadi = collect($request)->only([
                'no_ktp',
                'nama_pasien',
                'tgl_lahir',
                'alamat',
                'email',
                'gender',
                'golongan_darah',
                'no_hp_1',
                'uuid_faskes'
            ])->toArray();
            $inputDataPribadi['uuid_data_pribadi'] = $uuidDataPribadi;
            $inputDataPribadi['no_rm'] = $noRm;
            $saveDataPribadi = $this->dataPribadi->create($inputDataPribadi);
            if (!$saveDataPribadi) :
                throw new \Exception($this->outputMessage('unsaved', 'data pribadi'));
            endif;

            /**
             * save pendaftaran
             */
            $inputPendaftaran = collect($request)->only([
                'jenis_layanan',
                'jenis_pelayanan',
                'uuid_faskes'
            ])->toArray();
            $inputPendaftaran['uuid_pendaftaran'] = $uuidPendaftaran;
            $inputPendaftaran['uuid_data_pribadi'] = $uuidDataPribadi;
            $inputPendaftaran['no_pendaftaran'] = $this->nomorRegistrasi();
            $savePendaftaran = $this->pendaftaran->create($inputPendaftaran);
            if (!$savePendaftaran) :
                throw new \Exception($this->outputMessage('unsaved', 'pendaftaran'));
            endif;

            /**
             * save data penanggung jawab
             */
            $inputDataPj = collect($request)->only([
                'nama_pj',
                'no_hp',
                'id_provinsi',
                'id_kabupaten',
                'id_kecamatan',
                'id_desa'
            ])->toArray();
            $inputDataPj['uuid_pendaftaran'] = $uuidPendaftaran;
            $inputDataPj['uuid_data_pribadi'] = $uuidDataPribadi;
            $inputDataPj['alamat'] = $request['alamat_pj'];
            $saveDataPj = $this->dataPenanggungJawab->create($inputDataPj);
            if (!$saveDataPj) :
                throw new \Exception($this->outputMessage('unsaved', 'data penanggung jawab'));
            endif;

            /**
             * save data pendukung
             */
            $inputDataPendukung = collect($request)->only([
                'uuid_poliklinik_link_klinik',
                'kunjungan',
                'no_bpjs',
                'uuid_jp_link_faskes'
            ])->toArray();
            $inputDataPendukung['uuid_pendaftaran'] = $uuidPendaftaran;
            $inputDataPendukung['uuid_data_pribadi'] = $uuidDataPribadi;
            $saveDataPendukung = $this->dataPendukung->create($inputDataPendukung);
            if (!$saveDataPendukung) :
                throw new \Exception($this->outputMessage('unsaved', 'data pendukung'));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('saved', $request['nama_pasien']), 201, null);
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
     * store data to db pasien lama rawat jalan
     */
    public function storePasienLamaRawatJalan($request)
    {
        DB::beginTransaction();
        try {

            $uuidPendaftaran = Uuid::uuid4()->getHex();

            /**
             * get data pribadi
             */
            $getDataPribadi = $this->checkerHelpers->pasienChecker(['data_pribadi.no_rm' => $request['no_rm']]);
            if (is_null($getDataPribadi)) :
                throw new \Exception($this->outputMessage('not found', 'pasien'), 404);
            endif;
            $uuidDataPribadi = $getDataPribadi->uuid_data_pribadi;
            $namaPasien = $getDataPribadi->nama_pasien;

            /**
             * save pendaftaran
             */
            $inputPendaftaran = collect($request)->only([
                'jenis_layanan',
                'jenis_pelayanan',
                'uuid_faskes'
            ])->toArray();
            $inputPendaftaran['uuid_pendaftaran'] = $uuidPendaftaran;
            $inputPendaftaran['uuid_data_pribadi'] = $uuidDataPribadi;
            $inputPendaftaran['no_pendaftaran'] = $this->nomorRegistrasi();
            $savePendaftaran = $this->pendaftaran->create($inputPendaftaran);
            if (!$savePendaftaran) :
                throw new \Exception($this->outputMessage('unsaved', 'pendaftaran'));
            endif;

            /**
             * save data penanggung jawab
             */
            $inputDataPj = collect($request)->only([
                'nama_pj',
                'no_hp',
                'id_provinsi',
                'id_kabupaten',
                'id_kecamatan',
                'id_desa'
            ])->toArray();
            $inputDataPj['uuid_pendaftaran'] = $uuidPendaftaran;
            $inputDataPj['uuid_data_pribadi'] = $uuidDataPribadi;
            $inputDataPj['alamat'] = $request['alamat_pj'];
            $saveDataPj = $this->dataPenanggungJawab->create($inputDataPj);
            if (!$saveDataPj) :
                throw new \Exception($this->outputMessage('unsaved', 'data penanggung jawab'));
            endif;

            /**
             * save data pendukung
             */
            $inputDataPendukung = collect($request)->only([
                'uuid_poliklinik_link_klinik',
                'kunjungan',
                'no_bpjs',
                'uuid_jp_link_faskes'
            ])->toArray();
            $inputDataPendukung['uuid_pendaftaran'] = $uuidPendaftaran;
            $inputDataPendukung['uuid_data_pribadi'] = $uuidDataPribadi;
            $saveDataPendukung = $this->dataPendukung->create($inputDataPendukung);

            if (!$saveDataPendukung) :
                throw new \Exception($this->outputMessage('unsaved', 'data pendukung'));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('saved', $namaPasien), 201, null);
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
     * store data to db pasien baru igd
     */
    public function storePasienBaruIgd($request)
    {
        DB::beginTransaction();
        try {
            $uuidDataPribadi = Uuid::uuid4()->getHex();
            $uuidPendaftaran = Uuid::uuid4()->getHex();
            $noRm = $this->nomorRekamMedis();

            /**
             * save data pribadi
             */
            $inputDataPribadi = collect($request)->only([
                'no_ktp',
                'nama_pasien',
                'tgl_lahir',
                'alamat',
                'email',
                'gender',
                'golongan_darah',
                'no_hp_1',
                'uuid_faskes'
            ])->toArray();
            $inputDataPribadi['uuid_data_pribadi'] = $uuidDataPribadi;
            $inputDataPribadi['no_rm'] = $noRm;
            $saveDataPribadi = $this->dataPribadi->create($inputDataPribadi);
            if (!$saveDataPribadi) :
                throw new \Exception($this->outputMessage('unsaved', 'data pribadi'));
            endif;

            /**
             * save pendaftaran
             */
            $inputPendaftaran = collect($request)->only([
                'jenis_layanan',
                'jenis_pelayanan',
                'uuid_faskes'
            ])->toArray();
            $inputPendaftaran['uuid_pendaftaran'] = $uuidPendaftaran;
            $inputPendaftaran['uuid_data_pribadi'] = $uuidDataPribadi;
            $inputPendaftaran['no_pendaftaran'] = $this->nomorRegistrasi();
            $savePendaftaran = $this->pendaftaran->create($inputPendaftaran);
            if (!$savePendaftaran) :
                throw new \Exception($this->outputMessage('unsaved', 'pendaftaran'));
            endif;

            /**
             * save data penanggung jawab
             */
            $inputDataPj = collect($request)->only([
                'nama_pj',
                'no_hp',
                'id_provinsi',
                'id_kabupaten',
                'id_kecamatan',
                'id_desa'
            ])->toArray();
            $inputDataPj['uuid_pendaftaran'] = $uuidPendaftaran;
            $inputDataPj['uuid_data_pribadi'] = $uuidDataPribadi;
            $inputDataPj['alamat'] = $request['alamat_pj'];
            $saveDataPj = $this->dataPenanggungJawab->create($inputDataPj);
            if (!$saveDataPj) :
                throw new \Exception($this->outputMessage('unsaved', 'data penanggung jawab'));
            endif;

            /**
             * save data pendukung
             */
            $inputDataPendukung = collect($request)->only([
                'uuid_poliklinik_link_klinik',
                'kunjungan',
                'no_bpjs',
                'uuid_jp_link_faskes'
            ])->toArray();
            $inputDataPendukung['uuid_pendaftaran'] = $uuidPendaftaran;
            $inputDataPendukung['uuid_data_pribadi'] = $uuidDataPribadi;
            $saveDataPendukung = $this->dataPendukung->create($inputDataPendukung);
            if (!$saveDataPendukung) :
                throw new \Exception($this->outputMessage('unsaved', 'data pendukung'));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('saved', $request['nama_pasien']), 201, null);
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
     * store data to db pasien lama igd
     */
    public function storePasienLamaIgd($request)
    {
        DB::beginTransaction();
        try {

            $uuidPendaftaran = Uuid::uuid4()->getHex();

            /**
             * get data pribadi
             */
            $getDataPribadi = $this->checkerHelpers->pasienChecker(['data_pribadi.no_rm' => $request['no_rm']]);
            if (is_null($getDataPribadi)) :
                throw new \Exception($this->outputMessage('not found', 'pasien'), 404);
            endif;
            $uuidDataPribadi = $getDataPribadi->uuid_data_pribadi;
            $namaPasien = $getDataPribadi->nama_pasien;

            /**
             * save pendaftaran
             */
            $inputPendaftaran = collect($request)->only([
                'jenis_layanan',
                'jenis_pelayanan',
                'uuid_faskes'
            ])->toArray();
            $inputPendaftaran['uuid_pendaftaran'] = $uuidPendaftaran;
            $inputPendaftaran['uuid_data_pribadi'] = $uuidDataPribadi;
            $inputPendaftaran['no_pendaftaran'] = $this->nomorRegistrasi();
            $savePendaftaran = $this->pendaftaran->create($inputPendaftaran);
            if (!$savePendaftaran) :
                throw new \Exception($this->outputMessage('unsaved', 'pendaftaran'));
            endif;

            /**
             * save data penanggung jawab
             */
            $inputDataPj = collect($request)->only([
                'nama_pj',
                'no_hp',
                'id_provinsi',
                'id_kabupaten',
                'id_kecamatan',
                'id_desa'
            ])->toArray();
            $inputDataPj['uuid_pendaftaran'] = $uuidPendaftaran;
            $inputDataPj['uuid_data_pribadi'] = $uuidDataPribadi;
            $inputDataPj['alamat'] = $request['alamat_pj'];
            $saveDataPj = $this->dataPenanggungJawab->create($inputDataPj);
            if (!$saveDataPj) :
                throw new \Exception($this->outputMessage('unsaved', 'data penanggung jawab'));
            endif;

            /**
             * save data pendukung
             */
            $inputDataPendukung = collect($request)->only([
                'uuid_poliklinik_link_klinik',
                'kunjungan',
                'no_bpjs',
                'uuid_jp_link_faskes'
            ])->toArray();
            $inputDataPendukung['uuid_pendaftaran'] = $uuidPendaftaran;
            $inputDataPendukung['uuid_data_pribadi'] = $uuidDataPribadi;
            $saveDataPendukung = $this->dataPendukung->create($inputDataPendukung);

            if (!$saveDataPendukung) :
                throw new \Exception($this->outputMessage('unsaved', 'data pendukung'));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('saved', $namaPasien), 201, null);
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
     * store data to db pasien baru rawat inap
     */
    public function storePasienBaruRawatInap($request)
    {
        DB::beginTransaction();
        try {
            $uuidDataPribadi = Uuid::uuid4()->getHex();
            $uuidPendaftaran = Uuid::uuid4()->getHex();
            $noRm = $this->nomorRekamMedis();

            /**
             * save data pribadi
             */
            $inputDataPribadi = collect($request)->only([
                'no_ktp',
                'nama_pasien',
                'tgl_lahir',
                'alamat',
                'email',
                'gender',
                'golongan_darah',
                'no_hp_1',
                'uuid_faskes'
            ])->toArray();
            $inputDataPribadi['uuid_data_pribadi'] = $uuidDataPribadi;
            $inputDataPribadi['no_rm'] = $noRm;
            $saveDataPribadi = $this->dataPribadi->create($inputDataPribadi);
            if (!$saveDataPribadi) :
                throw new \Exception($this->outputMessage('unsaved', 'data pribadi'));
            endif;

            /**
             * save pendaftaran
             */
            $inputPendaftaran = collect($request)->only([
                'jenis_layanan',
                'jenis_pelayanan',
                'uuid_faskes'
            ])->toArray();
            $inputPendaftaran['uuid_pendaftaran'] = $uuidPendaftaran;
            $inputPendaftaran['uuid_data_pribadi'] = $uuidDataPribadi;
            $inputPendaftaran['no_pendaftaran'] = $this->nomorRegistrasi();
            $savePendaftaran = $this->pendaftaran->create($inputPendaftaran);
            if (!$savePendaftaran) :
                throw new \Exception($this->outputMessage('unsaved', 'pendaftaran'));
            endif;

            /**
             * save data penanggung jawab
             */
            $inputDataPj = collect($request)->only([
                'nama_pj',
                'no_hp',
                'id_provinsi',
                'id_kabupaten',
                'id_kecamatan',
                'id_desa'
            ])->toArray();
            $inputDataPj['uuid_pendaftaran'] = $uuidPendaftaran;
            $inputDataPj['uuid_data_pribadi'] = $uuidDataPribadi;
            $inputDataPj['alamat'] = $request['alamat_pj'];
            $saveDataPj = $this->dataPenanggungJawab->create($inputDataPj);
            if (!$saveDataPj) :
                throw new \Exception($this->outputMessage('unsaved', 'data penanggung jawab'));
            endif;

            /**
             * save data pendukung
             */
            $inputDataPendukung = collect($request)->only([
                'kunjungan',
                'uuid_kamar',
                'uuid_bed',
                'no_bpjs',
                'uuid_jp_link_faskes'
            ])->toArray();
            $inputDataPendukung['uuid_pendaftaran'] = $uuidPendaftaran;
            $inputDataPendukung['uuid_data_pribadi'] = $uuidDataPribadi;
            $saveDataPendukung = $this->dataPendukung->create($inputDataPendukung);
            if (!$saveDataPendukung) :
                throw new \Exception($this->outputMessage('unsaved', 'data pendukung'));
            endif;

            /**
             * update status bed
             */
            $getBed = $this->checkerHelpers->bedChecker(['uuid_bed' => $request['uuid_bed']]);
            if (!is_null($getBed)) :
                $updateBed = $this->bed->where('uuid_bed', $request['uuid_bed'])->update(['status' => 'available']);
                if (!$updateBed) :
                    throw new \Exception($this->outputMessage('update fail', 'status bed'));
                endif;

                $historyBedData = [
                    'uuid_data_pribadi' => $uuidDataPribadi,
                    'tgl_masuk' => $this->date,
                    'tgl_keluar' => null
                ];

                $saveHistoryBed = $this->historyBed->create($historyBedData);
                if (!$saveHistoryBed) :
                    throw new \Exception($this->outputMessage('unsaved', 'history bed'));
                endif;
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('saved', $request['nama_pasien']), 201, null);
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
     * store data to db pasien lama rawat inap
     */
    public function storePasienLamaRawatInap($request)
    {
        DB::beginTransaction();
        try {

            $uuidPendaftaran = Uuid::uuid4()->getHex();

            /**
             * get data pribadi
             */
            $getDataPribadi = $this->checkerHelpers->pasienChecker(['data_pribadi.no_rm' => $request['no_rm']]);
            if (is_null($getDataPribadi)) :
                throw new \Exception($this->outputMessage('not found', 'pasien'), 404);
            endif;
            $uuidDataPribadi = $getDataPribadi->uuid_data_pribadi;
            $namaPasien = $getDataPribadi->nama_pasien;

            /**
             * save pendaftaran
             */
            $inputPendaftaran = collect($request)->only([
                'jenis_layanan',
                'jenis_pelayanan',
                'uuid_faskes'
            ])->toArray();
            $inputPendaftaran['uuid_pendaftaran'] = $uuidPendaftaran;
            $inputPendaftaran['uuid_data_pribadi'] = $uuidDataPribadi;
            $inputPendaftaran['no_pendaftaran'] = $this->nomorRegistrasi();
            $savePendaftaran = $this->pendaftaran->create($inputPendaftaran);
            if (!$savePendaftaran) :
                throw new \Exception($this->outputMessage('unsaved', 'pendaftaran'));
            endif;

            /**
             * save data penanggung jawab
             */
            $inputDataPj = collect($request)->only([
                'nama_pj',
                'no_hp',
                'id_provinsi',
                'id_kabupaten',
                'id_kecamatan',
                'id_desa'
            ])->toArray();
            $inputDataPj['uuid_pendaftaran'] = $uuidPendaftaran;
            $inputDataPj['uuid_data_pribadi'] = $uuidDataPribadi;
            $inputDataPj['alamat'] = $request['alamat_pj'];
            $saveDataPj = $this->dataPenanggungJawab->create($inputDataPj);
            if (!$saveDataPj) :
                throw new \Exception($this->outputMessage('unsaved', 'data penanggung jawab'));
            endif;

            /**
             * save data pendukung
             */
            $inputDataPendukung = collect($request)->only([
                'uuid_kamar',
                'uuid_bed',
                'kunjungan',
                'no_bpjs',
                'uuid_jp_link_faskes'
            ])->toArray();
            $inputDataPendukung['uuid_pendaftaran'] = $uuidPendaftaran;
            $inputDataPendukung['uuid_data_pribadi'] = $uuidDataPribadi;
            $saveDataPendukung = $this->dataPendukung->create($inputDataPendukung);

            if (!$saveDataPendukung) :
                throw new \Exception($this->outputMessage('unsaved', 'data pendukung'));
            endif;

            /**
             * update status bed
             */
            $getBed = $this->checkerHelpers->bedChecker(['uuid_bed' => $request['uuid_bed']]);
            if (!is_null($getBed)) :
                $updateBed = $this->bed->where('uuid_bed', $request['uuid_bed'])->update(['status' => 'available']);
                if (!$updateBed) :
                    throw new \Exception($this->outputMessage('update fail', 'status bed'));
                endif;

                $historyBedData = [
                    'uuid_data_pribadi' => $uuidDataPribadi,
                    'tgl_masuk' => $this->date,
                    'tgl_keluar' => null
                ];

                $saveHistoryBed = $this->historyBed->create($historyBedData);
                if (!$saveHistoryBed) :
                    throw new \Exception($this->outputMessage('unsaved', 'history bed'));
                endif;
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('saved', $namaPasien), 201, null);
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
}
