<?php

use Illuminate\Support\Facades\Route;

/**
 * import controller
 */

use App\Http\Controllers\API\Web\ListPasien\PasienIgd\PasienIgdController;
use App\Http\Controllers\API\Web\ListPasien\PasienRawatInap\PasienRawatInapController;
use App\Http\Controllers\API\Web\ListPasien\KartuPasien\KartuPasienController;
use App\Http\Controllers\API\Web\ListPasien\SuratKeterangan\SuratKeteranganController;

Route::name('list-pasien.')->prefix('list-pasien')->group(function () {

    /**
     * IGD
     */
    Route::controller(PasienIgdController::class)
        ->name('pasien-igd.')
        ->prefix('pasien-igd')
        ->group(function () {
            Route::get('data', 'data')->name('data');
            Route::get('data/{uuidFaskes}', 'data')->name('data');
            Route::get('get/{uuidPendaftaran}', 'get')->name('get');
            Route::get('get/{uuidPendaftaran}/{uuidFaskes}', 'get')->name('get');
        });

    /**
     * pasien rawat inap
     */
    Route::controller(PasienRawatInapController::class)
        ->name('pasien-rawat-inap.')
        ->prefix('pasien-rawat-inap')
        ->group(function () {
            Route::get('data', 'data')->name('data');
            Route::get('data/{uuidFaskes}', 'data')->name('data');
            Route::get('get/{uuidPendaftaran}', 'get')->name('get');
            Route::get('get/{uuidPendaftaran}/{uuidFaskes}', 'get')->name('get');
        });

    /**
     * kartu pasien
     */
    Route::controller(KartuPasienController::class)
        ->name('kartu-pasien.')
        ->prefix('kartu-pasien')
        ->group(function () {
            Route::get('get/{noRm}', 'get')->name('get');
            Route::get('get/{noRm}/{uuidFaskes}', 'get')->name('get');
        });

    /**
     * surat keterangan sehat
     */
    Route::controller(SuratKeteranganController::class)
        ->name('surat-keterangan.')
        ->prefix('surat-keterangan')
        ->group(function () {
            Route::get('get/{noRm}', 'get')->name('get');
            Route::get('get/{noRm}/{uuidFaskes}', 'get')->name('get');
        });
});
