<?php

use Illuminate\Support\Facades\Route;

/**
 * import controller
 */

use App\Http\Controllers\API\Web\Pendaftaran\PendaftaranPasien\PendaftaranPasienController;
use App\Http\Controllers\API\Web\Pendaftaran\ListPendaftaran\ListPendaftaranController;

/**
 * pendaftaran pasien
 */
Route::controller(PendaftaranPasienController::class)
    ->name('pendaftaran-pasien.')
    ->prefix('pendaftaran-pasien')
    ->group(function () {

        Route::get('get/{noRm}', 'get')->name('get');

        /**
         * rawat jalan
         */
        Route::name('rawat-jalan.')
            ->prefix('rawat-jalan')
            ->group(function () {
                Route::post('store/pasien-baru', 'storePasienBaruRawatJalan')->name('storePasienBaruRawatJalan');
                Route::post('store/pasien-lama', 'storePasienLamaRawatJalan')->name('storePasienLamaRawatJalan');
            });

        /**
         * rawat igd
         */
        Route::name('igd.')
            ->prefix('igd')
            ->group(function () {
                Route::post('store/pasien-baru', 'storePasienBaruIgd')->name('storePasienBaruIgd');
                Route::post('store/pasien-lama', 'storePasienLamaIgd')->name('storePasienLamaIgd');
            });

        /**
         * rawat inap
         */
        Route::name('rawat-inap.')
            ->prefix('rawat-inap')
            ->group(function () {
                Route::post('store/pasien-baru', 'storePasienBaruRawatInap')->name('storePasienBaruRawatInap');
                Route::post('store/pasien-lama', 'storePasienLamaRawatInap')->name('storePasienLamaRawatInap');
            });
    });

/**
 * list pendaftaran
 */
Route::controller(ListPendaftaranController::class)
    ->name('list-pendaftaran.')
    ->prefix('list-pendaftaran')
    ->group(function () {
        Route::get('data/{uuidFaskes}', 'data')->name('data');
        Route::get('data', 'data')->name('data');
    });
