<?php

use App\Http\Controllers\LGAController;
use App\Http\Controllers\PollingUnitController;
use Illuminate\Support\Facades\Route;


// Route::get('/{uniqueid}', [PollingUnitController::class, 'show']);
// Route::get('/', [PollingUnitController::class, 'index']);

// Route::get('/create', 'PollingUnitController@create');
// Route::post('/store', 'PollingUnitController@store');

Route::redirect('/', '/polling-unit');

Route::resource('polling-unit', PollingUnitController::class)
    ->only(['index', 'show', 'create','store']);