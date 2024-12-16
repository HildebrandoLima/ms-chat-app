<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\UserController;
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
    Route::get('', [ChatController::class, 'index'])->name('message.index');
    Route::get('/{id}', [ChatController::class, 'show'])->name('message.show');
    Route::post('', [ChatController::class, 'store'])->name('message.store');
    Route::put('', [ChatController::class, 'update'])->name('message.update');
    Route::delete('/{id}', [ChatController::class, 'destroy'])->name('message.destroy');
});

//  User
Route::prefix('users')->group(function () {
    Route::get('', [UserController::class, 'index'])->name('user.index');
    Route::get('/{id}', [UserController::class, 'show'])->name('user.show');
    Route::post('', [UserController::class, 'store'])->name('user.store');
    Route::put('', [UserController::class, 'update'])->name('user.update');
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('user.destroy');
});
