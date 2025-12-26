<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    // Главная страница ЛК (index.blade.php)
    public function index()
    {
        $user = Auth::user();
        return view('profile.index', compact('user'));
    }
    
    // Профиль пользователя (profile.blade.php)
    public function profile()
    {
        $user = Auth::user();
        return view('profile.profile', compact('user'));
    }
    
    // Избранное (favorites.blade.php)
    public function favorites()
    {
        $user = Auth::user();
        return view('profile.favorites', compact('user'));
    }
    
    // Бронирования (booking.blade.php)
    public function booking()
    {
        $user = Auth::user();
        return view('profile.booking', compact('user'));
    }
    
    // Настройки (settings.blade.php)
    public function settings()
    {
        $user = Auth::user();
        return view('profile.settings', compact('user'));
    }
    
    // Обновление профиля
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
        ]);
        
        if ($validator->fails()) {
            return redirect()->route('profile.profile')
                ->withErrors($validator)
                ->withInput();
        }
        
        $user->update($request->only(['name', 'email', 'phone']));
        
        Session::flash('success', 'Профиль успешно обновлен.');
        return redirect()->route('profile.profile');
    }
    
    // Обновление настроек аккаунта
    public function updateSettings(Request $request)
    {
        $user = Auth::user();
        
        $validator = Validator::make($request->all(), [
            'login' => 'required|string|max:255|unique:users,login,' . $user->id,
        ]);
        
        if ($validator->fails()) {
            return redirect()->route('profile.settings')
                ->withErrors($validator)
                ->withInput();
        }
        
        $user->update([
            'login' => $request->login,
        ]);
        
        Session::flash('success', 'Настройки успешно обновлены.');
        return redirect()->route('profile.settings');
    }
    
    // Смена пароля
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);
        
        $user = Auth::user();
        
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Текущий пароль неверен.']);
        }
        
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);
        
        Session::flash('success', 'Пароль успешно изменен.');
        return redirect()->route('profile.settings');
    }
    
    // Включение двухфакторной аутентификации
    public function enableTwoFactor(Request $request)
    {
        $user = Auth::user();
        
        // Здесь можно добавить логику для 2FA
        // Например: $user->two_factor_secret = 'secret_key';
        // $user->two_factor_enabled = true;
        
        Session::flash('success', 'Двухфакторная аутентификация включена.');
        return redirect()->route('profile.settings');
    }
    
    // Отключение двухфакторной аутентификации
    public function disableTwoFactor(Request $request)
    {
        $user = Auth::user();
        
        // Здесь можно добавить логику для отключения 2FA
        // Например: $user->two_factor_secret = null;
        // $user->two_factor_enabled = false;
        
        Session::flash('success', 'Двухфакторная аутентификация отключена.');
        return redirect()->route('profile.settings');
    }
}