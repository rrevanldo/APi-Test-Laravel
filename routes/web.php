<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/push', [DataController::class, 'push']);
Route::get('/pull', [DataController::class, 'pull']);
Route::delete('/clear', [DataController::class, 'clear']);
