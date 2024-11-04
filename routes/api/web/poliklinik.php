<?php

use Illuminate\Support\Facades\Route;

/**
 * import controller
 */

use App\Http\Controllers\API\Web\Poliklinik\PoliklinikController;

Route::controller(PoliklinikController::class)
    ->name('poliklinik.')
    ->prefix('poliklinik')
    ->group(function () {
        Route::get('data/{uuidPoliklinikLinkKlinik}', 'data')->name('data')->withoutMiddleware('resitrict');
        Route::get('data/{uuidPoliklinikLinkKlinik}/{uuidFaskes}', 'data')->name('data');
        Route::get('get/pemeriksaan/{uuidPendaftaran}', 'get')->name('get')->withoutMiddleware('resitrict');
        Route::get('get/pemeriksaan/{uuidPendaftaran}/{uuidFaskses}', 'get')->name('get')->withoutMiddleware('resitrict');
        Route::post('store/perawat', 'storePerawat')->name('store')->withoutMiddleware('resitrict');
        Route::post('store/dokter', 'storeDokter')->name('update')->withoutMiddleware('resitrict');
    });
