<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // USER
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/form/lecturer', [UserController::class, 'user_form_lecturer'])->name('user.form.lecturer');
    Route::post('/user/store/lecturer', [UserController::class, 'user_store_lecturer'])->name('user.store.lecturer');
});

require __DIR__.'/auth.php';


// TEST CONTROLLER
Route::get('/test', [TestController::class, 'index']);