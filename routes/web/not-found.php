<?php

use Illuminate\Support\Facades\Route;

Route::get('not-found', function () {
   return view('auth.not-found.index');
})->name('not-found');
