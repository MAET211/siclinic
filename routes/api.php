<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AgendaController;

Route::middleware('api')->group(function () {
    Route::apiResource('agendas', AgendaController::class);
});
