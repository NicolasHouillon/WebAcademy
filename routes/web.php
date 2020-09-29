<?php

use App\Http\Controllers\CourseController;
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

Route::resource('courses', CourseController::class);

Route::get('/@{name}', [App\Http\Controllers\UserController::class, 'show'])->name('user_profile');
Route::get('/@{name}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('edit_profile');
Route::get('/@{name}/update', [App\Http\Controllers\UserController::class, 'update'])->name('update_profile');
