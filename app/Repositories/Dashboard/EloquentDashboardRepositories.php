<?php

namespace App\Repositories\Dashboard;

/**
 * import component
 */

use App\Exceptions\CustomException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

/**
 * import traits
 */

use App\Traits\Response;
use App\Traits\Message;

/**
 * import models
 */

use App\Models\Pendaftaran\DataPribadi\DataPribadi;
use App\Models\Pendaftaran\Pendaftaran\Pendaftaran;

/**
 * import helpers
 */

use App\Helpers\CheckerHelpers;

/**
 * import interface
 */

use App\Repositories\Dashboard\DashboardRepositories;

class EloquentDashboardRepositories implements DashboardRepositories
{
    use Message, Response;

    private $pendaftaran;
    private $dataPendukung;
    private $dataPribadi;
    private $checkerHelpers;
    private $date;

    public function __construct(
        Pendaftaran $pendaftaran,
        DataPribadi $dataPribadi,
        CheckerHelpers $checkerHelpers,
    ) {
        /**
         * initialize model
         */
        $this->pendaftaran = $pendaftaran;
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
            authAttribute()['role'] == 'superadmin' ? ['uuid_faskes' => $uuidFaskes] : ['uuid_faskes' => authAttribute()['id_faskes']]
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
            $dataPasien = $this->dataPribadi->where($this->whereCondition($uuidFaskes)[0])->count();
            $dataRawatInap = $this->pendaftaran->where(array_merge($this->whereCondition($uuidFaskes)[0], ['jenis_layanan' => 'rawat inap']))->count();
            $dataRawatJalan = $this->pendaftaran->where(array_merge($this->whereCondition($uuidFaskes)[0], ['jenis_layanan' => 'rawat jalan']))->count();
            $dataIgd = $this->pendaftaran->where(array_merge($this->whereCondition($uuidFaskes)[0], ['jenis_layanan' => 'igd']))->count();
            $data = [
                'pasien' => $dataPasien,
                'rawat_inap' => $dataRawatInap,
                'rawat_jalan' => $dataRawatJalan,
                'igd' => $dataIgd,
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
