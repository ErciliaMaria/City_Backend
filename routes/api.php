<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\CepController;
use Illuminate\Support\Facades\Route;

Route::get('/hello', function () {
    return response()->json(['message' => 'Hello, World!'], 200);
});
Route::prefix('/v1')->group(function () {
    Route::get('/citys', [CityController::class, 'execute']);
    Route::post('/cep/search', [CepController::class, 'searchByCep']);
});
