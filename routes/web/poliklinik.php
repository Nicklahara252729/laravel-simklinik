<?php

use Illuminate\Support\Facades\Route;

Route::get('poliklinik', function () {
    return view('poliklinik.index', [
        'page' => 'Poliklinik',
        'subpage' => ''
    ]);
})->name('poliklinik');