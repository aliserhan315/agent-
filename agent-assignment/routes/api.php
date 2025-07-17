<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Models\Agent;
use App\Http\Controllers\Api\AgentController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('agents')->group(function () {
    Route::get('/', [AgentController::class, 'index']);
    Route::post('/', [AgentController::class, 'store']);
    Route::get('{id}', [AgentController::class, 'show']);
    Route::put('{id}', [AgentController::class, 'update']);
    Route::delete('{id}', [AgentController::class, 'destroy']);
});

