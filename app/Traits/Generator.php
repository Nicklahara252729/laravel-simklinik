<?php

namespace App\Traits;

/**
 * import models
 */

use App\Models\Pendaftaran\Pendaftaran\Pendaftaran;
use App\Models\Pendaftaran\DataPribadi\DataPribadi;

/**
 * import helper
 */

use App\Helpers\CheckerHelpers;

trait Generator
{
    private $checkerHelpers;

    public function __construct(
        CheckerHelpers $checkerHelpers,
    ) {
        /**
         * initialize helper
         */
        $this->checkerHelpers = $checkerHelpers;
    }

    /**
     * nomor registrasi
     */
    public function nomorRegistrasi()
    {
        $lastNomor = Pendaftaran::select("no_pendaftaran")
            ->orderByDesc("id")
            ->first();
        $noSebelumnya = is_null($lastNomor) ? 0 : $lastNomor->no_pendaftaran;
        $noBerikutnya = $noSebelumnya;
        $noBerikutnya++;
        $return = sprintf("%06s", $noBerikutnya);
        return $return;
    }

    /**
     * nomor rekam medis
     */
    public function nomorRekamMedis()
    {
        $lastNomor = DataPribadi::select("no_rm")
            ->orderByDesc("id")
            ->first();
        $noSebelumnya = is_null($lastNomor) ? 0 : $lastNomor->no_rm;
        $noBerikutnya = $noSebelumnya;
        $noBerikutnya++;
        $return = sprintf("%06s", $noBerikutnya);
        return $return;
    }

    /**
     * nomor surat 
     */
    public function nomorSurat()
    {
        $nomorSurat = rand();
        $return = $nomorSurat;
        return $return;
    }
}
