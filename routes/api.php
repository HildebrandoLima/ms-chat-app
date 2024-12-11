<?php

use App\Http\Controllers\ChatController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//  Messages
Route::prefix('messages')->group(function () {
    Route::get('', [ChatController::class, 'index']);
    Route::get('/{id}', [ChatController::class, 'show']);
    Route::post('', [ChatController::class, 'store']);
    Route::put('', [ChatController::class, 'update']);
    Route::delete('/{id}', [ChatController::class, 'destroy']);
});
