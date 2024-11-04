<?php

use Illuminate\Support\Facades\Route;

Route::prefix('master-data')->name('master-data.')->group(function () {

    /**
     * Tindakan
     */
    Route::get('tindakan', function () {
        return view('master-data.tindakan.index', [
            'page' => 'Master Data',
            'subpage' => 'Tindakan'
        ]);
    })->name('tindakan');

    Route::get('tindakan', function () {
        return view('master-data.tindakan.index', [
            'page' => 'Master Data',
            'subpage' => 'Tindakan'
        ]);
    })->name('tindakan');
    
    Route::get('tindakan-kategori', function () {
        return view('master-data.tindakan-kategori.index', [
            'page' => 'Master Data',
            'subpage' => 'Kategori Tindakan'
        ]);
    })->name('tindakan-kategori');


    /**
     * Laborat
     */
    Route::get('laborat', function () {
        return view('master-data.laborat.index', [
            'page' => 'Master Data',
            'subpage' => 'Laborat'
        ]);
    })->name('laborat');

     /**
     * Laborat-kategori
     */
    Route::get('laborat-kategori', function () {
        return view('master-data.laborat-kategori.index', [
            'page' => 'Master Data',
            'subpage' => 'Laborat Kategori'
        ]);
    })->name('laborat-kategori');

    /**
     * Diagnosa
     */
    Route::get('diagnosa', function () {
        return view('master-data.diagnosa.index', [
            'page' => 'Master Data',
            'subpage' => 'Diagnosa'
        ]);
    })->name('diagnosa');

    /**
     * Kamar Rawat Inap
     */
    Route::get('kamar-rawat-inap', function () {
        return view('master-data.kamar-rawat-inap.index', [
            'page' => 'Master Data',
            'subpage' => 'Kamar Rawat Inap'
        ]);
    })->name('kamar-rawat-inap');

    /**
     * Poli
     */
    Route::get('poli', function () {
        return view('master-data.poli.index', [
            'page' => 'Master Data',
            'subpage' => 'Poli'
        ]);
    })->name('poli');

    /**
     * Pegawai
     */
    Route::get('pegawai', function () {
        return view('master-data.pegawai.index', [
            'page' => 'Master Data',
            'subpage' => 'Pegawai'
        ]);
    })->name('pegawai');

    /**
     * Jadwal Poli
     */
    Route::get('jadwal-poli', function () {
        return view('master-data.jadwal-poli.index', [
            'page' => 'Master Data',
            'subpage' => 'Jadwal Poli'
        ]);
    })->name('jadwal-poli');

    /**
     * Faskes
     */
    Route::get('faskes', function () {
        return view('master-data.faskes.index', [
            'page' => 'Master Data',
            'subpage' => 'Faskes'
        ]);
    })->name('Faskes');

    /**
     * Jenis Pembayaran
     */
    Route::get('jenis-pembayaran', function () {
        return view('master-data.jenis-pembayaran.index', [
            'page' => 'Master Data',
            'subpage' => 'Jenis Pembayaran'
        ]);
    })->name('jenis-pembayaran');

    /**
     * Petugas Poli
     */
    Route::get('petugas-poli', function () {
        return view('master-data.petugas-poli.index', [
            'page' => 'Master Data',
            'subpage' => 'Petugas Poli'
        ]);
    })->name('petugas-poli');

    /**
     * Klasifikasi Obat
     */
    Route::get('klasifikasi-obat', function () {
        return view('master-data.klasifikasi-obat.index', [
            'page' => 'Master Data',
            'subpage' => 'Klasifikasi Obat'
        ]);
    })->name('klasifikasi-obat');
  
    /*
     * Satuan Obat
     */
    Route::get('satuan-obat', function () {
        return view('master-data.satuan-obat.index', [
            'page' => 'Master Data',
            'subpage' => 'Satuan Obat'
        ]);
    })->name('satuan-obat');

    /**
     * Role
     */
    Route::get('role', function () {
        return view('master-data.role.index', [
            'page' => 'Master Data',
            'subpage' => 'Role'
        ]);
    })->name('role');

    /**
     * Role
     */
    Route::get('pengguna', function () {
        return view('master-data.pengguna.index', [
            'page' => 'Master Data',
            'subpage' => 'Pengguna'
        ]);
    })->name('pengguna');

    /**
     * Data obat
     */
    Route::get('data-obat', function () {
        return view('master-data.data-obat.index', [
            'page' => 'Master Data',
            'subpage' => 'Data obat'
        ]);
    })->name('data-obat');

    /**
     * Data obat
     */
    Route::get('data-spesialis', function () {
        return view('master-data.data-spesialis.index', [
            'page' => 'Master Data',
            'subpage' => 'Data Spesialis'
        ]);
    })->name('spesialis');
});
