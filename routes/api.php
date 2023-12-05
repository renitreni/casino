<?php

use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\UserController;
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

Route::post('login/csrf', [LoginController::class, 'authenticate'])->name('authenticate');
Route::middleware('auth:sanctum')->group(function () {

    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::post('check-token', [LoginController::class, 'checkToken'])->name('check-token');
    Route::post('agent-table', [UserController::class, 'agentTable'])->name('api.agent-table');
    Route::post('player-table', [UserController::class, 'playerTable'])->name('api.player-table');
    Route::post('admin-table', [UserController::class, 'adminTable'])->name('api.admin-table');

    Route::post('store/agent', [UserController::class, 'storeAgent'])->name('api.store.agent');
    Route::post('store/player', [UserController::class, 'storePlayer'])->name('api.store.player');
    Route::post('store/admin', [UserController::class, 'storeAdmin'])->name('api.store.admin');

    Route::put('edit/agent', [UserController::class, 'updateAgent'])->name('api.update.agent');
    Route::put('edit/player', [UserController::class, 'updatePlayer'])->name('api.update.player');
    Route::put('edit/admin', [UserController::class, 'updateAdmin'])->name('api.update.admin');

    Route::delete('delete/agent/{user}', [UserController::class, 'deleteAgent'])->name('api.delete.agent');
    Route::delete('delete/player/{user}', [UserController::class, 'deletePlayer'])->name('api.delete.player');
    Route::delete('delete/admin/{user}', [UserController::class, 'deleteAdmin'])->name('api.delete.admin');
});
