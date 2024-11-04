<?php

use Illuminate\Support\Facades\Route;

Route::prefix('pengaturan')->name('pengaturan.')->group(function () {

    /**
     * umum
     */
    Route::get('umum', function () {
        return view('pengaturan.umum.index', [
            'page' => 'Pengaturan',
            'subpage' => 'Umum'
        ]);
    })->name('umum');

    /**
     * bpjs
     */
    Route::get('bpjs', function () {
        return view('pengaturan.bpjs.index', [
            'page' => 'Pengaturan',
            'subpage' => 'BPJS'
        ]);
    })->name('bpjs');

    /**
     * satu sehat
     */
    Route::get('satu-sehat', function () {
        return view('pengaturan.satu-sehat.index', [
            'page' => 'Pengaturan',
            'subpage' => 'Satu Sehat'
        ]);
    })->name('satu-sehat');
});
