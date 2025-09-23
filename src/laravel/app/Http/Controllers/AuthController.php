<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Personnel;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Показать форму регистрации
    public function showRegistrationForm()
    {
        return view('registration');
    }

    // Обработка регистрации
    public function register(Request $request)
    {
        // Валидация данных
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:50|unique:clients,login',
            'email' => 'required|string|email|max:100|unique:clients,email',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:8|max:30|confirmed',
        ], [
            'username.required' => 'Поле логин обязательно для заполнения.',
            'username.unique' => 'Пользователь с таким логином уже существует.',
            'email.required' => 'Поле email обязательно для заполнения.',
            'email.email' => 'Введите корректный email адрес.',
            'email.unique' => 'Пользователь с таким email уже существует.',
            'phone.required' => 'Поле телефон обязательно для заполнения.',
            'password.required' => 'Поле пароль обязательно для заполнения.',
            'password.min' => 'Пароль должен содержать минимум 8 символов.',
            'password.max' => 'Пароль не должен превышать 30 символов.',
            'password.confirmed' => 'Пароли не совпадают.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Находим роль клиента
        $clientRole = Role::where('ID_role', 2)->first();

        if (!$clientRole) {
            // Создаем роль клиента если не существует
            $clientRole = Role::create([
                'Role' => 'client',
                'role_name' => 'client', 
                'description' => 'Обычный клиент'
            ]);
        }

        // Создаем клиента
        $client = Client::create([
            'login' => $request->username,
            'email' => $request->email,
            'phone_number' => $request->phone,
            'password' => Hash::make($request->password),
            'registration_date' => now(),
            'ID_role' => $clientRole->ID_role,
            'ID_personnel' => null
        ]);

        Auth::login($client);
        return redirect()->route('main')->with('success', 'Регистрация прошла успешно!');
    }

    // Показать форму авторизации
    public function showLoginForm()
    {
        return view('login');
    }

    // Обработка авторизации
    public function login(Request $request)
    {
        // Валидация данных
        $credentials = $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ], [
            'login.required' => 'Поле логин обязательно для заполнения.',
            'password.required' => 'Поле пароль обязательно для заполнения.',
        ]);

        // Пытаемся авторизовать клиента по логину
        if (Auth::attempt(['login' => $credentials['login'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            return redirect()->intended(route('main'))->with('success', 'Вы успешно авторизовались!');
        }

        // Если авторизация по логину не удалась, пробуем по email
        if (Auth::attempt(['email' => $credentials['login'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            return redirect()->intended(route('main'))->with('success', 'Вы успешно авторизовались!');
        }

        // Если авторизация не удалась
        return back()->withErrors([
            'login' => 'Неверные учетные данные.',
        ])->onlyInput('login');
    }

    // Выход из системы
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('main')->with('success', 'Вы вышли из системы.');
    }
}