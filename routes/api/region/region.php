<?php

use Illuminate\Support\Facades\Route;

/**
 * import controller
 */

use App\Http\Controllers\API\Region\Provinsi\ProvinsiController;
use App\Http\Controllers\API\Region\Kota\KotaController;
use App\Http\Controllers\API\Region\Kecamatan\KecamatanController;
use App\Http\Controllers\API\Region\Desa\DesaController;


Route::name('region.')->prefix('region')->group(function () {
    /**
     * provinsi
     */
    Route::controller(ProvinsiController::class)
        ->name('provinsi.')
        ->prefix('provinsi')
        ->group(function () {
            Route::get('data', 'data')->name('data');
            Route::get('get/{name}', 'get')->name('get');
        });

    /**
     * kota
     */
    Route::controller(KotaController::class)
        ->name('kota.')
        ->prefix('kota')
        ->group(function () {
            Route::get('get/id-provinsi/{idProvinsi}', 'getIdProvinsi')->name('get-id-provinsi');
            Route::get('get/id-kota/{idKota}', 'getIdKota')->name('get-id-kota');
        });

    /**
     * kecamatan
     */
    Route::controller(KecamatanController::class)
        ->name('kecamatan.')
        ->prefix('kecamatan')
        ->group(function () {
            Route::get('get/id-kota/{idKota}', 'getIdKota')->name('get-id-kota');
            Route::get('get/id-kecamatan/{idKecamatan}', 'getIdKecamatan')->name('get-id-kecamatan');
        });

    /**
     * desa
     */
    Route::controller(DesaController::class)
        ->name('desa.')
        ->prefix('desa')
        ->group(function () {
            Route::get('get/id-kecamatan/{idKecamatan}', 'getIdKecamatan')->name('get-id-kecamatan');
            Route::get('get/id-desa/{idDesa}', 'getIdDesa')->name('get-id-desa');
        });
});
