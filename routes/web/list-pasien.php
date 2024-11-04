<?php

use Illuminate\Support\Facades\Route;

Route::prefix('list-pasien')->name('list-pasien.')->group(function () {

    /**
     * Pasien IGD
     */
    Route::get('pasien-igd', function () {
        return view('list-pasien.pasien-igd.index', [
            'page' => 'Pasien',
            'subpage' => 'Pasien IGD'
        ]);
    })->name('pasien-igd');

    /**
     * Pasien Rawat Inap
     */
    Route::get('pasien-rawat-inap', function () {
        return view('list-pasien.pasien-rawat-inap.index', [
            'page' => 'Pasien',
            'subpage' => 'Pasien Rawat Inap'
        ]);
    })->name('pasien-rawat-inap');

    /**
     * Surat Keterangan
     */
    Route::get('surat-keterangan-kesehatan', function () {
        return view('list-pasien.surat-keterangan-kesehatan.index', [
            'page' => 'Pasien',
            'subpage' => 'Surat Keterangan Kesehatan'
        ]);
    })->name('surat-keterangan-kesehatan');

    /**
     * Kartu Pasien
     */
    Route::get('kartu-pasien', function () {
        return view('list-pasien.kartu-pasien.index', [
            'page' => 'Pasien',
            'subpage' => 'Kartu Pasien'
        ]);
    })->name('kartu-pasien');

    /**
     * Riwayat
     */
    Route::get('riwayat', function () {
        return view('list-pasien.riwayat.index', [
            'page' => 'Pasien',
            'subpage' => 'Riwayat'
        ]);
    })->name('riwayat');
});
