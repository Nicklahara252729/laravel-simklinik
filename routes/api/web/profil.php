<?php

use Illuminate\Support\Facades\Route;

/**
 * import controller
 */

use App\Http\Controllers\API\Profil\Profil\ProfilController;

Route::name('profil.')->prefix('profil')->group(function () {

    /**
     * Profil
     */
    Route::controller(ProfilController::class)
        ->group(function () {
            Route::get('data', 'data')->name('data');
            Route::put('reset-password', 'resetPassword')->name('resetPassword');
        });
});
