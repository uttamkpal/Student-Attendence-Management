<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('roles')->middleware(['auth:sanctum', 'role:admin'])->name('roles.')->group( function() {
    Route::get('/', [RoleController::class, 'index'])->name('index');

});

Route::prefix('users')->middleware(['auth:sanctum', 'role:admin'])->name('user.')->group( function() {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::patch('/{user}/edit', [UserController::class, 'update'])->name('update');
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('update');

});
