<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
    ]);
});

Route::get('/dashboard',[UserController::class ,'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('admin')->middleware(['auth', 'role:admin'])->name('admin.')->group( function() {
    Route::get('/', [AdminController::class, 'index'])->name('index');

    Route::get('users', [UserController::class, 'ViewIndex'])->name('users.index');
});
Route::prefix('professor')->middleware(['auth', 'role:professor'])->name('professor.')->group( function() {
    Route::get('/', [AdminController::class, 'index'])->name('index');
});
Route::prefix('staff')->middleware(['auth', 'role:staff'])->name('staff.')->group( function() {
    Route::get('/', [AdminController::class, 'index'])->name('index');
});
Route::prefix('student')->middleware(['auth', 'role:student'])->name('student.')->group( function() {
    Route::get('/', [AdminController::class, 'index'])->name('index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
