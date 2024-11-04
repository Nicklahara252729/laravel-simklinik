<?php

use Illuminate\Support\Facades\Route;

/**
 * import controller
 */

use App\Http\Controllers\API\Web\MasterData\Faskes\FaskesController;
use App\Http\Controllers\API\Web\MasterData\Tindakan\TindakanController;
use App\Http\Controllers\API\Web\MasterData\TindakanKategori\TindakanKategoriController;
use App\Http\Controllers\API\Web\MasterData\Diagnosa\DiagnosaController;
use App\Http\Controllers\API\Web\MasterData\JenisPembayaran\JenisPembayaranController;
use App\Http\Controllers\API\Web\MasterData\Laborat\LaboratController;
use App\Http\Controllers\API\Web\MasterData\LaboratKategori\LaboratKategoriController;
use App\Http\Controllers\API\Web\MasterData\Poli\PoliController;
use App\Http\Controllers\API\Web\MasterData\Pegawai\PegawaiController;
use App\Http\Controllers\API\Web\MasterData\Kamar\KamarController;
use App\Http\Controllers\API\Web\MasterData\DataObat\DataObatController;
use App\Http\Controllers\API\Web\MasterData\SatuanObat\SatuanObatController;
use App\Http\Controllers\API\Web\MasterData\KlasifikasiObat\KlasifikasiObatController;
use App\Http\Controllers\API\Web\MasterData\JadwalPoli\JadwalPoliController;
use App\Http\Controllers\API\Web\MasterData\Role\RoleController;
use App\Http\Controllers\API\Web\MasterData\PetugasPoli\PetugasPoliController;
use App\Http\Controllers\API\Web\MasterData\Pengguna\PenggunaController;
use App\Http\Controllers\API\Web\MasterData\DataSpesialis\DataSpesialisController;

Route::name('master-data.')->prefix('master-data')->group(function () {

    /**
     * faskes
     */
    Route::controller(FaskesController::class)
        ->name('faskes.')
        ->prefix('faskes')
        ->group(function () { 
            Route::get('data', 'data')->name('data');
            Route::get('get/{uuidFaskes}', 'get')->name('get')->withoutMiddleware('resitrict');
            Route::post('store', 'store')->name('store');
            Route::put('update/{uuidFaskes}', 'update')->name('update');
            Route::delete('delete/{uuidFaskes}', 'delete')->name('delete');
        });

    /**
     * tindakan dan tindakan kategori
     */

    Route::controller(TindakanController::class)
        ->name('tindakan.')
        ->prefix('tindakan')
        ->group(function () {
            Route::get('data/{uuidPoliLinkKlinik}', 'data')->name('data')->withoutMiddleware('resitrict');
            Route::get('data/{uuidFaskes}', 'data')->name('data');
            Route::get('get/{uuidTindakan}', 'get')->name('get');
            Route::post('store', 'store')->name('store');
            Route::put('update/{uuidTindakan}', 'update')->name('update');
            Route::delete('delete/{uuidTindakan}', 'delete')->name('delete');
        });

    /**
     * tindakan kategori
     */
    Route::controller(TindakanKategoriController::class)
        ->name('tindakan-kategori.')
        ->prefix('tindakan-kategori')
        ->group(function () {
            Route::get('data', 'data')->name('data');
            Route::get('data/{uuidFaskes}', 'data')->name('data');
            Route::get('get/{uuidTindakanKategori}', 'get')->name('get');
            Route::post('store', 'store')->name('store');
            Route::put('update/{uuidTindakanKategori}', 'update')->name('update');
            Route::delete('delete/{uuidTindakanKategori}', 'delete')->name('delete');
        });

    /**
     * diagnosa
     */
    Route::controller(DiagnosaController::class)
        ->name('diagnosa.')
        ->prefix('diagnosa')
        ->group(function () {
            Route::get('data', 'data')->name('data')->withoutMiddleware('resitrict');
            Route::get('get/{code}', 'get')->name('get');
            Route::post('store', 'store')->name('store');
            Route::put('update/{code}', 'update')->name('update');
            Route::delete('delete/{code}', 'delete')->name('delete');
        });

    /**
     * jenis pembayaran
     */
    Route::controller(JenisPembayaranController::class)
        ->name('jenis-pembayaran.')
        ->prefix('jenis-pembayaran')
        ->group(function () {
            Route::get('data', 'data')->name('data')->withoutMiddleware('resitrict');
            Route::get('get/{uuidJenisPembayaran}', 'get')->name('get');
            Route::post('store', 'store')->name('store');
            Route::put('update/{uuidJenisPembayaran}', 'update')->name('update');
            Route::put('update/status/{uuidJenisPembayaran}', 'updateStatus')->name('update.status');
            Route::delete('delete/{uuidJenisPembayaran}', 'delete')->name('delete');
        });


    /**
     * laborat
     */
    Route::controller(LaboratController::class)
        ->name('laborat.')
        ->prefix('laborat')
        ->group(function () {
            Route::get('data', 'data')->name('data');
            Route::get('data/{uuidFaskes}', 'data')->name('data');
            Route::get('get/{uuidLaborat}', 'get')->name('get');
            Route::post('store', 'store')->name('store');
            Route::put('update/{uuidLaborat}', 'update')->name('update');
            Route::delete('delete/{uuidLaborat}', 'delete')->name('delete');
        });

    /**
     * laborat kategori
     */
    Route::controller(LaboratKategoriController::class)
        ->name('laborat-kategori.')
        ->prefix('laborat-kategori')
        ->group(function () {
            Route::get('data', 'data')->name('data');
            Route::get('data/{uuidFaskes}', 'data')->name('data');
            Route::get('get/{uuidLaboratKategori}', 'get')->name('get');
            Route::post('store', 'store')->name('store');
            Route::put('update/{uuidLaboratKategori}', 'update')->name('update');
            Route::delete('delete/{uuidLaboratKategori}', 'delete')->name('delete');
        });

    /**
     * poli
     */
    Route::controller(PoliController::class)
        ->name('poli.')
        ->prefix('poli')
        ->group(function () {
            Route::get('data', 'data')->name('data')->withoutMiddleware('resitrict');
            Route::get('get/{uuidPoli}', 'get')->name('get');
            Route::post('store', 'store')->name('store');
            Route::put('update/{uuidPoli}', 'update')->name('update');
            Route::put('update/status/{uuidPoli}/{uuidKlinik}', 'updateStatus')->name('update.status');
            Route::delete('delete/{uuidPoli}', 'delete')->name('delete');
        });

    /**
     * pegawai
     */
    Route::controller(PegawaiController::class)
        ->name('pegawai.')
        ->prefix('pegawai')
        ->group(function () {
            Route::get('data', 'data')->name('data');
            Route::get('data/{uuidFaskes}', 'data')->name('data');
            Route::get('get/{uuidUser}', 'get')->name('get');
            Route::get('get/{uuidUser}/{uuidFaskes}', 'get')->name('get');
            Route::post('store', 'store')->name('store');
            Route::put('update/{uuidUser}', 'update')->name('update');
            Route::delete('delete/{uuidUser}', 'delete')->name('delete');
            Route::delete('delete/{uuidUser}/{uuidFaskes}', 'delete')->name('delete');
        });

    /**
     * kamar rawat inap
     */
    Route::controller(KamarController::class)
        ->name('kamar.')
        ->prefix('kamar')
        ->group(function () {
            Route::get('data', 'data')->name('data')->withoutMiddleware('resitrict');
            Route::get('data/{uuidFaskes}', 'data')->name('data');
            Route::get('get/bed/{uuidKamar}', 'dataBed')->name('data');
            Route::get('get/bed/{uuidKamar}/{uuidFaskes}', 'dataBed')->name('data.kamar');
            Route::get('get/{uuidKamar}', 'get')->name('get');
            Route::post('store', 'store')->name('store');
            Route::post('bed/store', 'storeBed')->name('store.bed');
            Route::put('update/{uuidKamar}', 'update')->name('update');
            Route::delete('delete/{uuidKamar}', 'delete')->name('delete');
            Route::delete('delete/bed/{uuidBed}', 'deleteBed')->name('delete.bed');
        });

    /**
     * Data Obat
     */
    Route::controller(DataObatController::class)
        ->name('data-obat.')
        ->prefix('data-obat')
        ->group(function () {
            Route::get('data', 'data')->name('data')->withoutMiddleware('resitrict');
            Route::get('data/{uuidFaskes}', 'data')->name('data');
            Route::get('get/{uuidDataObat}', 'get')->name('get');
            Route::post('store', 'store')->name('store');
            Route::put('update/{uuidDataObat}', 'update')->name('update');
            Route::put('update/status/{uuidDataObat}', 'updateStatus')->name('update.status');
            Route::delete('delete/{uuidDataObat}', 'delete')->name('delete');
        });

    /**
     * Satuan Obat
     */
    Route::controller(SatuanObatController::class)
        ->name('satuan-obat.')
        ->prefix('satuan-obat')
        ->group(function () {
            Route::get('data', 'data')->name('data')->withoutMiddleware('resitrict');
            Route::get('get/{uuidSatuanObat}', 'get')->name('get');
            Route::post('store', 'store')->name('store');
            Route::put('update/{uuidSatuanObat}', 'update')->name('update');
            Route::delete('delete/{uuidSatuanObat}', 'delete')->name('delete');
        });

    /**
     * Klasifikasi Obat
     */
    Route::controller(KlasifikasiObatController::class)
        ->name('klasifikasi-obat.')
        ->prefix('klasifikasi-obat')
        ->group(function () {
            Route::get('data', 'data')->name('data')->withoutMiddleware('resitrict');
            Route::get('get/{uuidKlasifikasiObat}', 'get')->name('get');
            Route::post('store', 'store')->name('store');
            Route::put('update/{uuidKlasifikasiObat}', 'update')->name('update');
            Route::delete('delete/{uuidKlasifikasiObat}', 'delete')->name('delete');
        });

    /**
     * Jadwal Poli
     */
    Route::controller(JadwalPoliController::class)
        ->name('jadwal-poli.')
        ->prefix('jadwal-poli')
        ->group(function () {
            Route::get('data', 'data')->name('data');
            Route::get('data/{uuidFaskes}', 'data')->name('data');
            Route::get('get/{uuidJadwalPoli}', 'get')->name('get');
            Route::post('store', 'store')->name('store');
            Route::put('update/{uuidJadwalPoli}', 'update')->name('update');
            Route::delete('delete/{uuidJadwalPoli}', 'delete')->name('delete');
        });

    /**
     * Role
     */
    Route::controller(RoleController::class)
        ->name('role.')
        ->prefix('role')
        ->group(function () {
            Route::get('/', 'getByLevel')->name('get-by-level')->withoutMiddleware('resitrict');
            Route::get('data', 'data')->name('data')->withoutMiddleware('resitrict');
            Route::get('get/{uuidRole}', 'get')->name('get');
            Route::post('store', 'store')->name('store');
            Route::put('update/{uuidRole}', 'update')->name('update');
            Route::delete('delete/{uuidRole}', 'delete')->name('delete');
        });

    /*
     * Petugas Poli
     */
    Route::controller(PetugasPoliController::class)
        ->name('petugas-poli.')
        ->prefix('petugas-poli')
        ->group(function () {
            Route::get('data', 'data')->name('data');
            Route::get('data/{uuidFaskes}', 'data')->name('data');
            Route::get('get/{uuidPetugasPoli}', 'get')->name('get');
            Route::post('store', 'store')->name('store');
            Route::put('update/{uuidPetugasPoli}', 'update')->name('update');
            Route::delete('delete/{uuidPetugasPoli}', 'delete')->name('delete');
        });

    /**
     * pengguna
     */
    Route::controller(PenggunaController::class)
        ->name('pengguna.')
        ->prefix('pengguna')
        ->group(function () {
            Route::get('data', 'data')->name('data');
            Route::get('get/{uuidUser}', 'get')->name('get');
            Route::post('store', 'store')->name('store');
            Route::put('update/{uuidUser}', 'update')->name('update');
            Route::delete('delete/{uuidUser}', 'delete')->name('delete');
        });

    /**
     * Data Spesialis
     */
    Route::controller(DataSpesialisController::class)
        ->name('data-spesialis.')
        ->prefix('data-spesialis')
        ->group(function () {
            Route::get('data', 'data')->name('data')->withoutMiddleware('resitrict');
            Route::get('get/{uuidDataSpesialis}', 'get')->name('get');
            Route::post('store', 'store')->name('store');
            Route::put('update/{uuidDataSpesialis}', 'update')->name('update');
            Route::delete('delete/{uuidDataSpesialis}', 'delete')->name('delete');
        });
});
