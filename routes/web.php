<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\Dashboard\AttachmentsController;
use App\Http\Controllers\Dashboard\CoursesController;
use App\Http\Controllers\Dashboard\GroupsController;
use App\Http\Controllers\Dashboard\LevelsController;
use App\Http\Controllers\Dashboard\SubjectsController;
use App\Http\Controllers\Dashboard\UsersController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\UserController;
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

Route::get('/courses/{slug}', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/show/{course}', [CourseController::class, 'show'])->name('courses.show');
//Route::resource('courses', CourseController::class);

Route::get('/@{name}', [UserController::class, 'show'])->name('user_profile');
Route::get('/@{name}/edit', [UserController::class, 'edit'])->name('edit_profile');
Route::get('/@{name}/update', [UserController::class, 'update'])->name('update_profile');
Route::post('/@{name}/upload', [UserController::class, 'uploadImage'])->name('upload');

// Paypal - NE PAS TOUCHER !
Route::get('/pay/{course}', [PaypalController::class, 'paymentHandle'])->name('make.payment');
Route::get('cancel-payment', [PaypalController::class, 'paymentCancel'])->name('cancel.payment');
Route::get('payment-success', [PaypalController::class, 'paymentSuccess'])->name('success.payment');

Route::name('admin.')->middleware('admin')->prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.home');
    })->name('home');
    Route::resource('attachments', AttachmentsController::class);
    Route::resource('courses', CoursesController::class);
    Route::resource('groups', GroupsController::class);
    Route::resource('levels', LevelsController::class);
    Route::resource('subjects', SubjectsController::class);
    Route::resource('users', UsersController::class);
    Route::post('users/{id}/edit', [UsersController::class, 'uploadImage'])->name('uploadAdmin');
});
