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
//Route::prefix('/courses')->group(function () {
//    Route::get('/', [App\Http\Controllers\CourseController::class, 'index'])->name('courses_index');
//    Route::get('/create', [App\Http\Controllers\CourseController::class, 'create'])->name('courses_create');
//    Route::post('/store', [App\Http\Controllers\CourseController::class, 'store'])->name('courses_store');Route::get('/create', [App\Http\Controllers\CourseController::class, 'create'])->name('courses_create');
//    Route::get('/{course}/edit', [App\Http\Controllers\CourseController::class, 'edit'])->name('courses_edit');
//    Route::patch('/course/update', [App\Http\Controllers\CourseController::class, 'update'])->name('courses_update');
//    Route::get('/{id}', [App\Http\Controllers\CourseController::class, 'show'])->name('courses_show');
//});

Route::get('/@{name}', [App\Http\Controllers\UserController::class, 'show'])->name('user_profile');
Route::get('/@{name}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('edit_profile');
Route::get('/@{name}/updtate', [App\Http\Controllers\UserController::class, 'update'])->name('update_profile');
