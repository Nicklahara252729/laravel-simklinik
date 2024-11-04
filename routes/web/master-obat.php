<?php

use Illuminate\Support\Facades\Route;

Route::get('master-obat', function () {
    return view('master-obat.index', [
        'page' => 'Master Obat',
        'subpage' => ''
    ]);
})->name('master-obat');
