<?php

use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\ChildenController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\Dashboard\AttachmentsController;
use App\Http\Controllers\Dashboard\CoursesController;
use App\Http\Controllers\Dashboard\GroupsController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\LevelsController;
use App\Http\Controllers\Dashboard\SubjectsController;
use App\Http\Controllers\Dashboard\UsersController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::middleware('auth')->group(function (){
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

    Route::prefix('courses')->group(function () {
        Route::get('/create', [CourseController::class, 'create'])->name('courses.create');
        Route::get('/{slug}', [CourseController::class, 'index'])->name('courses.index');
        Route::get('/show/{course}', [CourseController::class, 'show'])->name('courses.show');
        Route::get('/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
        Route::put('/{course}', [CourseController::class, 'update'])->name('courses.update');
        Route::post('/store', [CourseController::class, 'store'])->name('courses.store');
        Route::delete('/{course}', [CourseController::class, 'destroy'])->name('courses.delete');
    });

    Route::get('/@{name}', [UserController::class, 'show'])->name('user_profile');
    Route::get('/@{name}/edit', [UserController::class, 'edit'])->name('edit_profile');
    Route::put('/@{name}/update', [UserController::class, 'update'])->name('update_profile');
    Route::post('/@{name}/upload', [UserController::class, 'uploadImage'])->name('upload');
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('user_delete');
    Route::get('/annuaire', [UserController::class, 'index'])->name('annuaire');



// Paypal - NE PAS TOUCHER !
    Route::get('/pay/{course}', [PaypalController::class, 'paymentHandle'])->name('make.payment');
    Route::get('payment-success', [PaypalController::class, 'paymentSuccess'])->name('success.payment');

    Route::name('admin.')->middleware('admin')->prefix('admin')->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::resource('attachments', AttachmentsController::class);
        Route::resource('courses', CoursesController::class);
        Route::resource('groups', GroupsController::class);
        Route::resource('levels', LevelsController::class);
        Route::resource('subjects', SubjectsController::class);
        Route::post('subjects/{subject}', [SubjectsController::class, 'uploadImage'])->name('uploadImage');
        Route::resource('users', UsersController::class);
        Route::post('users/{id}/edit', [UserController::class, 'uploadImage'])->name('uploadAdmin');
        Route::put('/{course}/validate', [CoursesController::class, 'valid'])->name('courses.validate');
    });


    Route::post('courses/{id}/upload', [CourseController::class, 'uploadFile'])->name('uploadFile');
    Route::delete('attachments/{attachment}', [AttachmentController::class, 'destroy'])->name('destroy_attachment');


    Route::prefix('messages')->group(function () {
        Route::get('/', [MessageController::class, 'index'])->name('messages');
        Route::get('/{user}', [MessageController::class, 'show'])->name('messages.show');
        Route::get('/create/{user}', [MessageController::class, 'create'])->name('message.create');
        Route::post('/store/{user}', [MessageController::class, 'store'])->name('message.store');
    });

    Route::name('children.')->prefix('children')->group(function () {
        Route::post('/store', [ChildenController::class, 'store'])->name('store');
        Route::delete('/destroy/{child}', [ChildenController::class, 'destroy'])->name('destroy');
    });
});

