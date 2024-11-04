<?php

namespace App\Repositories\ListPasien\SuratKeterangan;

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
 * import helpers
 */

use App\Helpers\CheckerHelpers;


/**
 * import interface
 */

use App\Repositories\ListPasien\SuratKeterangan\SuratKeteranganRepositories;

class EloquentSuratKeteranganRepositories implements SuratKeteranganRepositories
{
    use Message, Response, Generator;

    private $checkerHelpers;
    private $date;

    public function __construct(
        CheckerHelpers $checkerHelpers,
    ) {

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
    private function whereCondition($uuidFaskes = null, $noRm = null)
    {
        $whereCondition = [
            authAttribute()['role'] == 'superadmin' ? ['data_pribadi.uuid_faskes' => $uuidFaskes] : ['data_pribadi.uuid_faskes' => authAttribute()['id_faskes']],
            ['data_pribadi.no_rm' => $noRm, 'data_pribadi.uuid_faskes' => authAttribute()['role'] == 'superadmin' ? $uuidFaskes : authAttribute()['id_faskes']]
        ];
        return $whereCondition;
    }

    /**
     * get data by no rm
     */
    public function get($noRm, $uuidFaskes)
    {
        try {
            /**
             * get single data
             */
            $getPasien = $this->checkerHelpers->pasienChecker($this->whereCondition($uuidFaskes, $noRm)[1]);
            if (is_null($getPasien)) :
                throw new CustomException(json_encode([$this->outputMessage('not found', 'pasien'), 404]));
            endif;

            /**
             * convert tanggal lahir
             */
            $tglLahir = Carbon::parse($getPasien->tgl_lahir)->locale('id');
            $tglLahir->settings(['formatFunction' => 'translatedFormat']);

            /**
             * set response body
             */
            $data = [
                "no_surat" => $this->nomorSurat(),
                "no_rm" => $getPasien->no_rm,
                "nama_pasien" => $getPasien->nama_pasien,
                "tgl_lahir" => $tglLahir->format('j F Y'),
                "alamat" => $getPasien->alamat,
                "gender" => $getPasien->gender,
                "no_hp" => $getPasien->no_hp_1,
            ];

            $response = $this->sendResponse(null, 200, $data);
        } catch (CustomException $ex) {
            $ex = json_decode($ex->getMessage());
            $response = $this->sendResponse($ex[0], $ex[1]);
        } catch (\Exception $e) {
            $response = $this->sendResponse($e->getMessage(), 500);
        }

        return $response;
    }
}
