<?php

use Illuminate\Support\Facades\Route;

Route::get('management-kamar', function () {
   return view('management-kamar.index', ['page' => "Management Kamar"]);
})->name('management-kamar');
