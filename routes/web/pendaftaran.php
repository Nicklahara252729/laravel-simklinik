<?php

use Illuminate\Support\Facades\Route;

Route::prefix('pendaftaran')->name('pendaftaran.')->group(function () {

    /**
     * pendaftaran pasien
     */
    Route::get('pendaftaran-pasien', function () {
        return view('pendaftaran.pendaftaran-pasien.index', [
            'page' => 'Pendaftaran',
            'subpage' => 'Pendaftaran Pasien'
        ]);
    })->name('pendaftaran-pasien');

    /**
     * pasien
     */
    Route::get('pasien', function () {
        return view('pendaftaran.pasien.index', [
            'page' => 'Pendaftaran',
            'subpage' => 'Pasien'
        ]);
    })->name('pasien');

    /**
     * antrian online
     */
    Route::get('antrian-online', function () {
        return view('pendaftaran.antrian-online.index', [
            'page' => 'Pendaftaran',
            'subpage' => 'Antrian Online'
        ]);
    })->name('antrian-online');

    /**
     * List Pendaftaran
     */
    Route::get('list-pendaftaran', function () {
        return view('pendaftaran.list-pendaftaran.index', [
            'page' => 'Pendaftaran',
            'subpage' => 'List Pendaftaran'
        ]);
    })->name('list-pendaftaran');
});
