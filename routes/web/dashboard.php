<?php

use Illuminate\Support\Facades\Route;

Route::get('dashboard', function () {
    return view('dashboard.index', ['page' => "Dashboard"]);
})->name('dashboard');
