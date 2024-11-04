<?php

use Illuminate\Support\Facades\Route;

/**
 * import controller
 */

use App\Http\Controllers\API\Web\Farmasi\Resep\ResepController;

Route::name('farmasi.')->prefix('farmasi')->group(function () {

   /**
    * Resep
    */
   Route::controller(ResepController::class)
      ->name('resep.')
      ->prefix('resep')
      ->group(function () {
         Route::get('data', 'data')->name('data');
         Route::post('store', 'store')->name('store');
      });
});
