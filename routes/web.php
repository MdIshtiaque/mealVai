<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MealSystemController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware(['auth', 'verifyUser'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/create-meal-system', [MealSystemController::class, 'createMealSystemView'])->name('create.meal.system');
});
Route::post('verifying', [RegisteredUserController::class, 'verify'])->name('verify');


require __DIR__.'/auth.php';
