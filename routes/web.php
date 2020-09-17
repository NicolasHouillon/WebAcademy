<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

Route::prefix('/courses')->group(function () {
    Route::get('/', [App\Http\Controllers\CourseController::class, 'index'])->name('courses_index');
    Route::get('/{id}', [App\Http\Controllers\CourseController::class, 'show'])->name('courses_show');
});

Route::get('/@{name}', [App\Http\Controllers\UserController::class, 'show'])->name('user_profile');
