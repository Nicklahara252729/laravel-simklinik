<?php

namespace App\Repositories\ListPasien\PasienIgd;

/**
 * import component
 */

use Illuminate\Support\Facades\DB;
use App\Exceptions\CustomException;
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

/**
 * import helpers
 */

use App\Helpers\CheckerHelpers;


/**
 * import interface
 */

use App\Repositories\ListPasien\PasienIgd\PasienIgdRepositories;

class EloquentPasienIgdRepositories implements PasienIgdRepositories
{
    use Message, Response, Generator;

    private $pendaftaran;
    private $dataPenanggungJawab;
    private $dataPendukung;
    private $dataPribadi;
    private $checkerHelpers;
    private $date;

    public function __construct(
        Pendaftaran $pendaftaran,
        DataPribadi $dataPribadi,
        DataPendukung $dataPendukung,
        DataPenanggungJawab $dataPenanggungJawab,
        CheckerHelpers $checkerHelpers,
    ) {
        /**
         * initialize model
         */
        $this->pendaftaran = $pendaftaran;
        $this->dataPenanggungJawab = $dataPenanggungJawab;
        $this->dataPendukung = $dataPendukung;
        $this->dataPribadi = $dataPribadi;

        /**
         * initialize helper
         */
        $this->checkerHelpers = $checkerHelpers;

        /**
         * static value
         */
        $this->date = Carbon::now()->toDateString();
    }

    /**
     * where condition
     */
    private function whereCondition($uuidFaskes = null, $uuidPendaftaran = null)
    {
        $whereCondition = [
            authAttribute()['role'] == 'superadmin' ? ['data_pribadi.uuid_faskes' => $uuidFaskes] : ['data_pribadi.uuid_faskes' => authAttribute()['id_faskes']],
            ['pendaftaran.uuid_pendaftaran' => $uuidPendaftaran, 'pendaftaran.uuid_faskes' => authAttribute()['role'] == 'superadmin' ? $uuidFaskes : authAttribute()['id_faskes']]
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
             * data pasien
             */
            $data = $this->dataPribadi->select(
                'no_rm',
                'nama_pasien',
                'alamat',
                'email',
                'no_ktp',
                'gender',
                'no_hp_1 as no_hp',
                'pendaftaran.uuid_pendaftaran',
                'pendaftaran.created_at'
            )
                ->join('pendaftaran', 'pendaftaran.uuid_data_pribadi', '=', 'data_pribadi.uuid_data_pribadi')
                ->where([$this->whereCondition($uuidFaskes)], [0])
                ->where(['pendaftaran.jenis_layanan' => 'igd'])
                ->orderBy('data_pribadi.id', 'desc')
                ->get();
            if (count($data) <= 0) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'pasien'), 404]));
            endif;

            /**
             * set output
             */
            $output = [];
            foreach ($data as $key => $value) :

                /**
                 * convert tanggal pendaftaran
                 */
                $tanggalPendaftaran = Carbon::parse($value->created_at)->locale('id');
                $tanggalPendaftaran->settings(['formatFunction' => 'translatedFormat']);

                /**
                 * set output
                 */
                $set = [
                    'uuid_pendaftaran' => $value->uuid_pendaftaran,
                    'no_rm' => $value->no_rm,
                    'nama_pasien' => $value->nama_pasien,
                    'alamat' => $value->alamat,
                    'email' => $value->email,
                    'no_ktp' => $value->no_ktp,
                    'gender' => $value->gender,
                    'no_hp' => $value->no_hp,
                    'tanggal' => $tanggalPendaftaran->format('d-m-Y'),
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
             * get single data
             */
            $getPendfataran = $this->pendaftaran
                ->join('data_pribadi', 'pendaftaran.uuid_data_pribadi', '=', 'data_pribadi.uuid_data_pribadi')
                ->join('data_penanggung_jawab', 'data_penanggung_jawab.uuid_pendaftaran', '=', 'pendaftaran.uuid_pendaftaran')
                ->join('reg_provinces', 'reg_provinces.id', '=', 'data_penanggung_jawab.id_provinsi')
                ->join('reg_regencies', 'reg_regencies.id', '=', 'data_penanggung_jawab.id_kabupaten')
                ->join('reg_districts', 'reg_districts.id', '=', 'data_penanggung_jawab.id_kecamatan')
                ->join('reg_villages', 'reg_villages.id', '=', 'data_penanggung_jawab.id_desa')
                ->select(
                    'data_pribadi.uuid_data_pribadi',
                    'data_pribadi.uuid_faskes',
                    'data_pribadi.no_ktp',
                    'data_pribadi.nama_pasien',
                    'data_pribadi.tgl_lahir',
                    'data_pribadi.alamat',
                    'data_pribadi.email',
                    'data_pribadi.gender',
                    'data_pribadi.golongan_darah',
                    'data_pribadi.no_hp_1',
                    'data_pribadi.no_rm',
                    'data_penanggung_jawab.uuid_data_pj',
                    'data_penanggung_jawab.nama_pj',
                    'data_penanggung_jawab.no_hp',
                    'reg_provinces.name as provinsi',
                    'reg_regencies.name as kabupaten',
                    'reg_districts.name as kecamatan',
                    'reg_villages.name as desa',
                    'reg_provinces.id as id_provinsi',
                    'reg_regencies.id as id_kabupaten',
                    'reg_districts.id as id_kecamatan',
                    'reg_villages.id as id_desa',
                    'pendaftaran.jenis_layanan',
                    'pendaftaran.uuid_pendaftaran'
                )
                ->where($this->whereCondition($uuidFaskes, $uuidPendaftaran)[1])
                ->first();

            if (is_null($getPendfataran)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'pasien'), 404]));
            endif;


            /**
             * set output
             */
            $output = [
                'pendaftaran' => [
                    'jenis_layanan' => $getPendfataran->jenis_layanan
                ],
                'data_pribadi' => [
                    'uuid_data_pribadi' => $getPendfataran->uuid_data_pribadi,
                    'uuid_faskes' => $getPendfataran->uuid_faskes,
                    'no_ktp' => $getPendfataran->no_ktp,
                    'nama_pasien' => $getPendfataran->nama_pasien,
                    'tgl_lahir' => $getPendfataran->tgl_lahir,
                    'alamat' => $getPendfataran->alamat,
                    'email' => $getPendfataran->email,
                    'gender' => $getPendfataran->gender,
                    'golongan_darah' => $getPendfataran->golongan_darah,
                    'no_hp_1' => $getPendfataran->no_hp_1,
                    'no_rm' => $getPendfataran->no_rm,
                ],
                'data_pj' => [
                    'uuid_data_pj' => $getPendfataran->uuid_data_pj,
                    'nama_pj' => $getPendfataran->nama_pj,
                    'no_hp' => $getPendfataran->no_hp,
                    'provinsi' => [
                        'id' => $getPendfataran->id_provinsi,
                        'nama' => $getPendfataran->provinsi
                    ],
                    'kabupaten' => [
                        'id' => $getPendfataran->id_kabupaten,
                        'nama' => $getPendfataran->kabupaten
                    ],
                    'kecamatan' => [
                        'id' => $getPendfataran->id_kecamatan,
                        'nama' => $getPendfataran->kecamatan
                    ],
                    'desa' => [
                        'id' => $getPendfataran->id_desa,
                        'nama' => $getPendfataran->desa
                    ]
                ],
            ];

            $response = $this->sendResponse(null, 200, $output);
        } catch (CustomException $ex) {
            $ex = json_decode($ex->getMessage());
            $response = $this->sendResponse($ex[0], $ex[1]);
        } catch (\Exception $e) {
            $response = $this->sendResponse($e->getMessage(), 500);
        }

        return $response;
    }
}
