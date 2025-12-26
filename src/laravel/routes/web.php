<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;  

// Основные страницы
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

// Маршруты аутентификации
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Маршруты активации аккаунта
Route::get('/activate/{token}', [AuthController::class, 'activateAccount'])->name('activate');
Route::get('/activation-required', [AuthController::class, 'showActivationRequired'])->name('activation.required');
Route::post('/activation/resend', [AuthController::class, 'resendActivationEmail'])->name('activation.resend');
Route::post('/check-activation', [AuthController::class, 'checkActivationStatus'])->name('check.activation');

// Админ-панель
Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/tables', [AdminController::class, 'tables'])->name('admin.tables');
    Route::get('/queries', [AdminController::class, 'queries'])->name('admin.queries');
    
    Route::post('/quick-add', [AdminController::class, 'quickAdd'])->name('admin.quick-add');
    Route::post('/quick-edit/{model}/{id}', [AdminController::class, 'quickEdit'])->name('admin.quick-edit');
    Route::delete('/quick-delete/{model}/{id}', [AdminController::class, 'quickDelete'])->name('admin.quick-delete');
});


use App\Http\Controllers\ProfileController;

// Личный кабинет
Route::middleware(['auth'])->prefix('profile')->name('profile.')->group(function () {
    // Главная страница ЛК
    Route::get('/', [ProfileController::class, 'index'])->name('index');
    
    // Профиль пользователя
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::put('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
    
    // Избранное
    Route::get('/favorites', [ProfileController::class, 'favorites'])->name('favorites');
    
    // Бронирования
    Route::get('/booking', [ProfileController::class, 'booking'])->name('booking');
    
    // Настройки
    Route::get('/settings', [ProfileController::class, 'settings'])->name('settings');
    Route::put('/settings/update', [ProfileController::class, 'updateSettings'])->name('settings.update');
    Route::put('/settings/password', [ProfileController::class, 'updatePassword'])->name('settings.password');
    
    // 2FA
    Route::post('/settings/enable-2fa', [ProfileController::class, 'enableTwoFactor'])->name('settings.enable-2fa');
    Route::post('/settings/disable-2fa', [ProfileController::class, 'disableTwoFactor'])->name('settings.disable-2fa');
});
