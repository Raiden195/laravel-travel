<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Personnel;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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
        // Валидация данных с reCAPTCHA
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:50|unique:clients,login',
            'email' => 'required|string|email|max:100|unique:clients,email',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:8|max:30|confirmed',
            'g-recaptcha-response' => 'required'
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
            'g-recaptcha-response.required' => 'Пожалуйста, подтвердите, что вы не робот.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Проверка reCAPTCHA через Google API
        $recaptchaResponse = $request->input('g-recaptcha-response');
        $recaptchaResult = $this->verifyRecaptcha($recaptchaResponse, $request->ip());
        
        if (!$recaptchaResult['success']) {
            return redirect()->back()
                ->withErrors(['g-recaptcha-response' => 'Ошибка проверки reCAPTCHA. Попробуйте еще раз.'])
                ->withInput();
        }

        // Находим роль клиента
        $clientRole = Role::where('ID_role', 2)->first();

        if (!$clientRole) {
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
        // Валидация данных с reCAPTCHA
        $validator = Validator::make($request->all(), [
            'login' => 'required|string',
            'password' => 'required|string',
            'g-recaptcha-response' => 'required'
        ], [
            'login.required' => 'Поле логин обязательно для заполнения.',
            'password.required' => 'Поле пароль обязательно для заполнения.',
            'g-recaptcha-response.required' => 'Пожалуйста, подтвердите, что вы не робот.',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->onlyInput('login');
        }

        // Проверка reCAPTCHA через Google API
        $recaptchaResponse = $request->input('g-recaptcha-response');
        $recaptchaResult = $this->verifyRecaptcha($recaptchaResponse, $request->ip());
        
        if (!$recaptchaResult['success']) {
            return back()
                ->withErrors(['g-recaptcha-response' => 'Ошибка проверки reCAPTCHA. Попробуйте еще раз.'])
                ->onlyInput('login');
        }

        // Пытаемся авторизовать клиента по логину
        if (Auth::attempt(['login' => $request->login, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended(route('main'))->with('success', 'Вы успешно авторизовались!');
        }

        // Если авторизация по логину не удалась, пробуем по email
        if (Auth::attempt(['email' => $request->login, 'password' => $request->password])) {
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

 
    private function verifyRecaptcha($recaptchaResponse, $userIp)
    {
        $secretKey = env('RECAPTCHA_SECRET_KEY');
        
        // Проверяем, что ключ существует
        if (!$secretKey) {
            return [
                'success' => false,
                'error' => 'ReCAPTCHA secret key not configured'
            ];
        }

        try {
            // Отправляем запрос к Google reCAPTCHA API
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => $secretKey,
                'response' => $recaptchaResponse,
                'remoteip' => $userIp
            ]);

            $result = $response->json();
            
            return [
                'success' => $result['success'] ?? false,
                'score' => $result['score'] ?? 0,
                'errors' => $result['error-codes'] ?? []
            ];
            
        } catch (\Exception $e) {
            // Логируем ошибку, но не блокируем пользователя
            Log::error('ReCAPTCHA verification failed: ' . $e->getMessage());
            
            return [
                'success' => true,
                'error' => $e->getMessage()
            ];
        }
    }

    // Метод для отладки reCAPTCHA
    public function recaptchaStatus()
    {
        $siteKey = env('RECAPTCHA_SITE_KEY');
        $secretKey = env('RECAPTCHA_SECRET_KEY');
        
        return response()->json([
            'site_key_configured' => !empty($siteKey),
            'secret_key_configured' => !empty($secretKey),
            'site_key_prefix' => substr($siteKey, 0, 10) . '...',
            'secret_key_prefix' => substr($secretKey, 0, 10) . '...'
        ]);
    }
}