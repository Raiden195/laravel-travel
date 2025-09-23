<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;  

Route::get('/', function () {
    return view('main');
})->name('main');

Route::get('/hottour', function () {
    return view('hottour');
})->name('hottour');

Route::get('/tour', function () {
    return view('tour');
})->name('tour');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/tables', [AdminController::class, 'tables'])->name('admin.tables');
    Route::get('/queries', [AdminController::class, 'queries'])->name('admin.queries');
    
    Route::post('/quick-add', [AdminController::class, 'quickAdd'])->name('admin.quick-add');
    Route::post('/quick-edit/{model}/{id}', [AdminController::class, 'quickEdit'])->name('admin.quick-edit');
    Route::delete('/quick-delete/{model}/{id}', [AdminController::class, 'quickDelete'])->name('admin.quick-delete');
});