<?php

namespace App\Repositories\Poliklinik;

/**
 * import component
 */

use App\Exceptions\CustomException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Ramsey\Uuid\Uuid;

/**
 * import traits
 */

use App\Traits\Response;
use App\Traits\Message;

/**
 * import models
 */

use App\Models\Pendaftaran\DataPendukung\DataPendukung;
use App\Models\Pendaftaran\DataPenanggungJawab\DataPenanggungJawab;
use App\Models\Pendaftaran\DataPribadi\DataPribadi;
use App\Models\Pendaftaran\Pendaftaran\Pendaftaran;
use App\Models\MasterData\Poliklinik\PoliklinikLinkKlinik\PoliklinikLinkKlinik;
use App\Models\MasterData\Poliklinik\Pemeriksaan\Pemeriksaan;
use App\Models\Farmasi\Resep\Resep;
use App\Models\MasterData\DataObat\DataObat;
use App\Models\MasterData\Tindakan\Tindakan\Tindakan;


/**
 * import helpers
 */

use App\Helpers\CheckerHelpers;

/**
 * import interface
 */

use App\Repositories\Poliklinik\PoliklinikRepositories;

class EloquentPoliklinikRepositories implements PoliklinikRepositories
{
    use Message, Response;

    private $pendaftaran;
    private $dataPendukung;
    private $dataPenanggungJawab;
    private $dataPribadi;
    private $poliklinikLinkKlinik;
    private $poliklinik;
    private $checkerHelpers;
    private $pemeriksaan;
    private $resep;
    private $dataObat;
    private $tindakan;
    private $date;
    private $uuid;

    public function __construct(
        Pendaftaran $pendaftaran,
        DataPribadi $dataPribadi,
        DataPendukung $dataPendukung,
        DataPenanggungJawab $dataPenanggungJawab,
        PoliklinikLinkKlinik $poliklinikLinkKlinik,
        Pemeriksaan $pemeriksaan,
        Resep $resep,
        DataObat $dataObat,
        Tindakan $tindakan,
        CheckerHelpers $checkerHelpers,
    ) {
        /**
         * initialize model
         */
        $this->pendaftaran = $pendaftaran;
        $this->dataPenanggungJawab = $dataPenanggungJawab;
        $this->dataPendukung = $dataPendukung;
        $this->dataPribadi = $dataPribadi;
        $this->poliklinikLinkKlinik = $poliklinikLinkKlinik;
        $this->pemeriksaan = $pemeriksaan;
        $this->resep = $resep;
        $this->dataObat = $dataObat;
        $this->tindakan = $tindakan;

        /**
         * initialize helper
         */
        $this->checkerHelpers = $checkerHelpers;

        /**
         * static value
         */
        $this->date = Carbon::now()->toDateString();
        $this->uuid = Uuid::uuid4()->getHex();
    }

    /**
     * where condition
     */
    private function whereCondition($param, $uuidFaskes = null)
    {
        $uuidFaskes = authAttribute()['role'] == 'superadmin' ? $uuidFaskes : authAttribute()['id_faskes'];
        $whereCondition = [
            ['pendaftaran.uuid_faskes' => $uuidFaskes, 'data_pendukung.uuid_poliklinik_link_klinik' => $param],
            ['pendaftaran.uuid_faskes' => $uuidFaskes, 'pendaftaran.uuid_pendaftaran' => $param]
        ];
        return $whereCondition;
    }

    /**
     * all record
     */
    public function data($uuidPoliklinikLinkKlinik, $uuidFaskes, $filter)
    {
        try {

            /**
             * data pendaftaran
             */
            $dateFilter = is_null($filter) ?
                'jenis_layanan = "rawat jalan"'
                : '(' . 'jenis_layanan = "rawat jalan" AND DATE(pendaftaran.created_at) BETWEEN "' . $filter[0] . '" AND "' . $filter[1] . '")';

            $data = $this->pendaftaran->select(
                'pendaftaran.uuid_pendaftaran',
                'no_pendaftaran',
                'nama_pasien',
                DB::raw("CASE WHEN status = 1 THEN 'selesai' WHEN status = 0 THEN 'diproses' ELSE 'status tidak valid' END AS status_pendaftaran"),
                'jenis_layanan',
                'jenis_pelayanan',
                'pendaftaran.uuid_data_pribadi',
                'uuid_poliklinik_link_klinik',
                'no_rm'
            )
                ->join('data_pribadi', 'pendaftaran.uuid_data_pribadi', '=', 'data_pribadi.uuid_data_pribadi')
                ->join('data_pendukung', 'pendaftaran.uuid_pendaftaran', '=', 'data_pendukung.uuid_pendaftaran')
                ->where($this->whereCondition($uuidPoliklinikLinkKlinik, $uuidFaskes)[0])
                ->whereRaw($dateFilter)
                ->orderBy('pendaftaran.id', 'desc')
                ->get();

            if (count($data) <= 0) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'poliklinik'), 404]));
            endif;

            $output = [];
            foreach ($data as $key => $value) :
                /**
                 * get nama penanggung jawab
                 */
                $getPj = $this->dataPenanggungJawab->select('nama_pj')
                    ->where('uuid_data_pribadi', $value->uuid_data_pribadi)
                    ->orderBy('id', 'desc')
                    ->first();
                if (is_null($getPj)) :
                    throw new CustomException(json_encode([$this->outputMessage('not found', 'data penanggung jawab pasien ' . $value->nama_pasien), 404]));
                endif;

                /**
                 * set output
                 */
                $set = [
                    'uuid_pendaftaran' => $value->uuid_pendaftaran,
                    'no_rm' => $value->no_rm,
                    'no_antrian' => null,
                    'no_pendaftaran' => $value->no_pendaftaran,
                    'status_pendaftaran' => $value->status_pendaftaran,
                    'jenis_layanan' => $value->jenis_layanan,
                    'jenis_pelayanan' => $value->jenis_pelayanan,
                    'nama_pasien' => $value->nama_pasien,
                    'nama_pj' => $getPj->nama_pj
                ];

                array_push($output, $set);
            endforeach;

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
    public function get($uuidPendaftaran, $uuidFaskes)
    {
        try {

            /**
             * data pendaftaran
             */
            $getData = $this->pendaftaran->select(
                'pendaftaran.uuid_pendaftaran',
                'pendaftaran.no_pendaftaran',
                DB::raw("CASE WHEN status = 1 THEN 'selesai' WHEN status = 0 THEN 'diproses' ELSE 'status tidak valid' END AS status_pendaftaran"),
                'pendaftaran.jenis_layanan',
                'pendaftaran.jenis_pelayanan',
                'pendaftaran.uuid_data_pribadi',
                'data_pribadi.nama_pasien',
                'data_pribadi.tgl_lahir',
                'data_pribadi.alamat',
                'data_pribadi.gender',
                'data_pribadi.golongan_darah',
                'data_pribadi.no_hp_1',
                'data_pribadi.no_rm',
                'data_pendukung.uuid_poliklinik_link_klinik',
                'data_pendukung.kunjungan'
            )
                ->join('data_pribadi', 'data_pribadi.uuid_data_pribadi', '=', 'pendaftaran.uuid_data_pribadi')
                ->join('data_pendukung', 'data_pendukung.uuid_data_pribadi', '=', 'pendaftaran.uuid_data_pribadi')
                ->where($this->whereCondition($uuidPendaftaran, $uuidFaskes)[1])
                ->first();
            if (is_null($getData)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'poliklinik'), 404]));
            endif;

            /**
             * set umur
             */
            $bornDate   = Carbon::parse($getData->tgl_lahir);
            $now        = $this->date;
            $usia       = $bornDate->diffInYears($now);
            $getData['umur'] = $usia . ' Tahun ';

            /**
             * data pemeriksaan
             */

            $getPemeriksan = $this->checkerHelpers->pemeriksaanChecker(['uuid_pendaftaran' => $getData->uuid_pendaftaran]);
            $getData['tindakan_perawat'] = is_null($getPemeriksan) ? null : json_decode($getPemeriksan->tindakan_perawat);
            $getData['tindakan_dokter'] = is_null($getPemeriksan) ? null : json_decode($getPemeriksan->tindakan_dokter);
            $getData['diagnosa'] = is_null($getPemeriksan) ? null : json_decode($getPemeriksan->diagnosa);
            $getData['keterangan'] = is_null($getPemeriksan) ? null : $getPemeriksan->keterangan;
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
     * store pemeriksaan
     */
    public function storePerawat($request)
    {
        DB::beginTransaction();
        try {

            /**
             * set tindakan perawat
             */
            $tindakanPerawat = null;
            if (isset($request['tindakan_perawat'])) :
                $tindakanPerawat = [];
                foreach ($request['tindakan_perawat'] as $key => $value) :
                    $getTindakan = $this->checkerHelpers->tindakanChecker(['uuid_tindakan' => $value]);
                    $set = [
                        'uuid_tindakan' => $value,
                        'nama' => $getTindakan->nama,
                        'harga' => $getTindakan->harga,
                    ];
                    array_push($tindakanPerawat, $set);
                endforeach;
                $tindakanPerawat = json_encode($tindakanPerawat);
            endif;
            $request['tindakan_perawat'] = $tindakanPerawat;

            /**
             * save pemeriksaan
             */
            $request = collect($request)->except(['uuid_faskes'])->toArray();
            $savePemeriksaan = $this->pemeriksaan->create($request);
            if (!$savePemeriksaan) :
                throw new \Exception($this->outputMessage('unsaved', 'pemeriksaan'));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('saved', 'pemeriksaan'), 201, null);
        } catch (CustomException $ex) {
            $ex = json_decode($ex->getMessage());
            $response = $this->sendResponse($ex[0], $ex[1]);
        } catch (\Exception $e) {
            DB::rollback();
            $response = $this->sendResponse($e->getMessage(), 500);
        }

        /**
         * Send response to controller
         */
        return $response;
    }

    /**
     * update pemeriksaan
     */
    public function storeDokter($request)
    {
        DB::beginTransaction();
        try {

            $uuidPendaftaran = $request['uuid_pendaftaran'];

            /**
             * check uuid pemeriksaan
             */
            $checkPemeriksaan = $this->checkerHelpers->pemeriksaanChecker(['uuid_pendaftaran' => $uuidPendaftaran]);
            if (is_null($checkPemeriksaan)) :
                throw new \Exception($this->outputMessage('not found', 'pemeriksaan'));
            endif;

            /**
             * Save data pemeriksaan
             */
            $pemeriksaanData = collect($request)->only(['tindakan_dokter', 'diagnosa', 'keterangan', 'uuid_pendaftaran'])->toArray();

            /**
             * set tindakan dokter value
             */
            $tindakanDokter = null;
            if (isset($request['tindakan_dokter'])) :
                $tindakanDokter = [];
                foreach ($request['tindakan_dokter'] as $key => $value) :
                    $getTindakan = $this->checkerHelpers->tindakanChecker(['uuid_tindakan' => $value]);
                    $set = [
                        'uuid_tindakan' => $value,
                        'nama' => $getTindakan->nama,
                        'harga' => $getTindakan->harga,
                    ];
                    array_push($tindakanDokter, $set);
                endforeach;
                $tindakanDokter = json_encode($tindakanDokter);
            endif;
            $request['tindakan_dokter'] = $tindakanDokter;

            /**
             * set diagnosa value
             */
            $diagnosa = null;
            if (isset($request['diagnosa'])) :
                $diagnosa = [];
                foreach ($request['diagnosa'] as $key => $value) :
                    $set = ['code' => $value];
                    array_push($diagnosa, $set);
                endforeach;
                $diagnosa = json_encode($diagnosa);
            endif;
            $pemeriksaanData['diagnosa'] = $diagnosa;

            /**
             * update pemeriksaan
             */
            $saveDataPemeriksaan = $this->pemeriksaan->where('uuid_pendaftaran', $uuidPendaftaran)->update($pemeriksaanData);
            if (!$saveDataPemeriksaan) :
                throw new \Exception($this->outputMessage('update fail', 'pemeriksaan'));
            endif;

            /**
             * Save data resep
             */
            $uuidDataObat = $request['uuid_data_obat'];
            $resepData = [];
            foreach ($uuidDataObat as $key => $uuid) :
                $dataObat = $this->checkerHelpers->dataObatChecker(['uuid_data_obat' => $uuid]);
                if (is_null($dataObat)) :
                    throw new \Exception($this->outputMessage('not found', 'data obat'));
                endif;
                $set = [
                    'uuid_resep' => $this->uuid,
                    'uuid_pemeriksaan' => $checkPemeriksaan->uuid_pemeriksaan,
                    'uuid_data_obat' => $uuid,
                    'aturan_pakai' => $request['aturan_pakai'][$key],
                    'jumlah' => $request['jumlah'][$key],
                    'harga' => $dataObat->harga_satuan,
                    'batch_no' => $dataObat->no_batch,
                    'expired' => $dataObat->tgl_expired,
                    'total' => $request['total'][$key],
                    'created_at' => $this->date,
                    'updated_at' => $this->date,
                ];
                array_push($resepData, $set);
            endforeach;

            /**
             * save resep data
             */
            $saveDataResep = $this->resep->insert($resepData);
            if (!$saveDataResep) :
                throw new \Exception($this->outputMessage('unsaved', 'resep'));
            endif;

            DB::commit();
            $response = $this->sendResponse($this->outputMessage('updated', 'pemeriksaan'), 201, null);
        } catch (CustomException $ex) {
            $ex = json_decode($ex->getMessage());
            $response = $this->sendResponse($ex[0], $ex[1]);
        } catch (\Exception $e) {
            DB::rollback();
            $response = $this->sendResponse($e->getMessage(), 500);
        }

        /**
         * Send response to controller
         */
        return $response;
    }
}
