<?php

use Illuminate\Support\Facades\Route;

Route::get('profil', function () {
    return view('profil.index', [
        'page' => 'Profil',
        'subpage' => ''
    ]);
})->name('profil');