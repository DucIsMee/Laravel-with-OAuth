<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('login');
});

Route::get('/login', function(){
    return view('login');
});

Route::get('/dashboard', function(){
    return view('dashboard');
})->middleware('auth');

Route::get('/auth/{provider}', [AuthController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [AuthController::class, 'callback']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
