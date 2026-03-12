<?php

use Illuminate\Support\Facades\Route;

Route::get('/welcome', function () {
    $data = [];
    $data['user'] = 'John Doe';
    return view('welcome', $data);
});

// Route::view('/student', 'student.index');

Route::redirect('/', '/welcome');

Route::get('/student/{name}', function($name) {
    return "Hello ".$name;
});

Route::get('/student/{name?}', function($name = null) {
    if(is_null($name)) {
        return "Hello there...";
    } else {
        return "Hello ".$name;
    }
})->name('user');

Route::prefix('student')
    ->name('student.')
    ->group(function(){
        Route::get('/{name?}', function($name = null) {
            if(is_null($name)) {
                return "Hello there...";
            } else {
                return "Hello ".$name;
            }
        })->name('name');
});
