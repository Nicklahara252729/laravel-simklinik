<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login.index', ['title' => "Login"]);
})->name('index');