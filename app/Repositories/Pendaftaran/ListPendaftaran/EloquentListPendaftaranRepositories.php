<?php

namespace App\Repositories\Pendaftaran\ListPendaftaran;

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

use App\Repositories\Pendaftaran\ListPendaftaran\ListPendaftaranRepositories;

class EloquentListPendaftaranRepositories implements ListPendaftaranRepositories
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
    private function whereCondition($uuidFaskes = null)
    {
        $whereCondition = [
            authAttribute()['role'] == 'superadmin' ? ['pendaftaran.uuid_faskes' => $uuidFaskes] : ['pendaftaran.uuid_faskes' => authAttribute()['id_faskes']],
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
             * data pendaftaran
             */
            $data = $this->pendaftaran->select(
                'uuid_pendaftaran',
                'no_pendaftaran',
                'nama_pasien',
                'jenis_layanan',
                'jenis_pelayanan',
                'pendaftaran.uuid_data_pribadi',
                'pendaftaran.created_at'
            )
                ->join('data_pribadi', 'pendaftaran.uuid_data_pribadi', '=', 'data_pribadi.uuid_data_pribadi')
                ->where($this->whereCondition($uuidFaskes)[0])
                ->orderBy('pendaftaran.id', 'desc')
                ->get();

            if (count($data) <= 0) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'list pendaftaran'), 404]));
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
                 * get poli
                 */
                $getPoli = $this->dataPendukung->select('poliklinik')
                    ->join('poliklinik_link_klinik', 'data_pendukung.uuid_poliklinik_link_klinik', '=', 'data_pendukung.uuid_poliklinik_link_klinik')
                    ->join('poliklinik', 'poliklinik_link_klinik.uuid_poliklinik', '=', 'poliklinik.uuid_poliklinik')
                    ->where('uuid_data_pribadi', $value->uuid_data_pribadi)
                    ->first();
                if (is_null($getPoli)) :
                    throw new CustomException(json_encode([$this->outputMessage('not found', 'data penanggung jawab'), 404]));
                endif;

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
                    'no_pendaftaran' => $value->no_pendaftaran,
                    'jenis_layanan' => $value->jenis_layanan,
                    'jenis_pelayanan' => $value->jenis_pelayanan,
                    'nama_pasien' => $value->nama_pasien,
                    'nama_pj' => $getPj->nama_pj,
                    'poliklinik' => $getPoli->poliklinik,
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
}
