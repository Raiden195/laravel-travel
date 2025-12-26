<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Mail\ClientActivationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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

        // ВСЕ клиенты получают ID_role = 2
        $clientRoleId = 2;

        // Создаем клиента
        $client = Client::create([
            'login' => $request->username,
            'email' => $request->email,
            'phone_number' => $request->phone,
            'password' => Hash::make($request->password),
            'registration_date' => now(),
            'ID_role' => $clientRoleId,
            'ID_personnel' => null,
            'is_active' => false,
            'email_verified_at' => null,
            'email_verification_token' => Str::random(60),
        ]);

        // Отправляем письмо активации
        try {
            Mail::to($client->email)->send(new ClientActivationMail($client));
            Log::info('Письмо активации отправлено клиенту: ' . $client->email);
        } catch (\Exception $e) {
            Log::error('Ошибка отправки письма активации: ' . $e->getMessage());
        }

        return redirect()->route('login')
            ->with('success', 'Регистрация прошла успешно! Проверьте вашу почту для активации аккаунта.');
    }

    // Показать форму авторизации
    public function showLoginForm()
    {
        return view('login');
    }

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

        // КРИТИЧЕСКАЯ ОШИБКА БЫЛА ЗДЕСЬ!
        // Используем правильную логику поиска пользователя
        $loginInput = $request->login;
        
        // Определяем, это email или логин
        $isEmail = filter_var($loginInput, FILTER_VALIDATE_EMAIL);
        
        if ($isEmail) {
            // Если введен email - ищем по email
            $client = Client::where('email', $loginInput)->first();
        } else {
            // Если введен логин - ищем по логину
            $client = Client::where('login', $loginInput)->first();
        }

        // Проверяем существование клиента
        if (!$client) {
            return back()->withErrors([
                'login' => 'Пользователь не найден.',
            ])->onlyInput('login');
        }

        // Проверяем правильность пароля с подробным логированием
        Log::info('Login attempt', [
            'user_id' => $client->ID_client,
            'login' => $client->login,
            'email' => $client->email,
            'input_login' => $loginInput,
            'is_email' => $isEmail,
            'stored_password_hash' => substr($client->password, 0, 20) . '...'
        ]);

        // Проверка пароля
        if (!Hash::check($request->password, $client->password)) {
            Log::warning('Password mismatch', [
                'user_id' => $client->ID_client,
                'input_password' => $request->password
            ]);
            
            return back()->withErrors([
                'login' => 'Неверный пароль.',
            ])->onlyInput('login');
        }

        Log::info('Password verified successfully', ['user_id' => $client->ID_client]);

        // ПРОВЕРЯЕМ АКТИВАЦИЮ АККАУНТА
    
        $isActive = $client->isActive();
        
        // Если пользователь не активен, но он существовал до внедрения системы активации
        // активируем его автоматически
        if (!$isActive) {
            // Проверяем, может это старый пользователь
            if (empty($client->email_verified_at) && $client->created_at < now()->subDays(1)) {
                // Старый пользователь - активируем автоматически
                Log::info('Auto-activating old user', ['user_id' => $client->ID_client]);
                $client->update([
                    'is_active' => true,
                    'email_verified_at' => now(),
                    'email_verification_token' => null
                ]);
                $isActive = true;
            } else {
                // Новый пользователь без активации
                Log::warning('Account not active', ['user_id' => $client->ID_client]);
                return back()
                    ->withErrors([
                        'login' => 'Ваш аккаунт не активирован. Пожалуйста, проверьте вашу почту.'
                    ])
                    ->withInput($request->only('login'))
                    ->with('activation_required', true)
                    ->with('client_email', $client->email);
            }
        }

        // Авторизуем клиента
        try {
            Auth::login($client, $request->filled('remember'));
            $request->session()->regenerate();
            
            Log::info('User logged in successfully', [
                'user_id' => $client->ID_client,
                'session_id' => session()->getId()
            ]);
            
            return redirect()->intended(route('main'))->with('success', 'Вы успешно авторизовались!');
            
        } catch (\Exception $e) {
            Log::error('Login error', [
                'user_id' => $client->ID_client,
                'error' => $e->getMessage()
            ]);
            
            return back()->withErrors([
                'login' => 'Ошибка при авторизации. Попробуйте еще раз.'
            ])->onlyInput('login');
        }
    }

    // Выход из системы
    public function logout(Request $request)
    {
        $userId = Auth::id();
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        Log::info('User logged out', ['user_id' => $userId]);
        
        return redirect()->route('main')->with('success', 'Вы вышли из системы.');
    }

    public function activateAccount($token)
    {
        Log::info('Account activation attempt', ['token' => $token]);
        
        // Ищем клиента по токену
        $client = Client::where('email_verification_token', $token)->first();
        
        if (!$client) {
            Log::warning('Invalid activation token', ['token' => $token]);
            return redirect()->route('login')
                ->with('error', 'Недействительная или устаревшая ссылка активации.');
        }
        
        // Проверяем, может клиент уже активирован
        if ($client->is_active && $client->email_verified_at) {
            Log::info('Account already activated', ['user_id' => $client->ID_client]);
            return redirect()->route('login')
                ->with('info', 'Ваш аккаунт уже активирован. Вы можете войти в систему.');
        }
        
        // Активируем аккаунт
        try {
            $client->activate();
            Log::info('Account activated successfully', ['user_id' => $client->ID_client]);
            
            return redirect()->route('login')
                ->with('success', 'Поздравляем! Ваш аккаунт успешно активирован. Теперь вы можете войти в систему.');
                
        } catch (\Exception $e) {
            Log::error('Account activation failed', [
                'user_id' => $client->ID_client,
                'error' => $e->getMessage()
            ]);
            
            return redirect()->route('login')
                ->with('error', 'Ошибка при активации аккаунта. Попробуйте позже.');
        }
    }

    /**
     * Повторная отправка письма активации
     */
    public function resendActivationEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:clients,email',
        ]);
        
        $client = Client::where('email', $request->email)
                        ->where('is_active', false)
                        ->first();
        
        if (!$client) {
            return back()->with('error', 'Аккаунт не найден или уже активирован.');
        }
        
        // Генерируем новый токен, если старый истек или отсутствует
        if (empty($client->email_verification_token)) {
            $client->email_verification_token = Str::random(60);
            $client->save();
        }
        
        // Отправляем письмо
        try {
            Mail::to($client->email)->send(new ClientActivationMail($client));
            Log::info('Resent activation email', ['user_id' => $client->ID_client]);
            
            return back()->with('success', 'Новая ссылка активации отправлена на вашу почту.');
        } catch (\Exception $e) {
            Log::error('Error resending activation email', [
                'user_id' => $client->ID_client,
                'error' => $e->getMessage()
            ]);
            return back()->with('error', 'Ошибка при отправке письма. Попробуйте позже.');
        }
    }

    /**
     * Страница с сообщением о необходимости активации
     */
    public function showActivationRequired()
    {
        if (!Auth::check() || Auth::user()->isActive()) {
            return redirect()->route('main');
        }
        
        return view('auth.activation-required', [
            'email' => Auth::user()->email
        ]);
    }

    /**
     * Проверка статуса активации (для AJAX запросов)
     */
    public function checkActivationStatus(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:clients,email',
        ]);
        
        $client = Client::where('email', $request->email)->first();
        
        return response()->json([
            'is_active' => $client->isActive(),
            'email_verified_at' => $client->email_verified_at,
            'created_at' => $client->created_at,
        ]);
    }

    private function verifyRecaptcha($recaptchaResponse, $userIp)
    {
        $secretKey = env('RECAPTCHA_SECRET_KEY');
        
        if (!$secretKey) {
            Log::error('ReCAPTCHA secret key not configured');
            return [
                'success' => false,
                'error' => 'ReCAPTCHA secret key not configured'
            ];
        }

        try {
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => $secretKey,
                'response' => $recaptchaResponse,
                'remoteip' => $userIp
            ]);

            $result = $response->json();
            
            Log::info('ReCAPTCHA verification result', [
                'success' => $result['success'] ?? false,
                'score' => $result['score'] ?? 0
            ]);
            
            return [
                'success' => $result['success'] ?? false,
                'score' => $result['score'] ?? 0,
                'errors' => $result['error-codes'] ?? []
            ];
            
        } catch (\Exception $e) {
            Log::error('ReCAPTCHA verification failed: ' . $e->getMessage());
            
            // В режиме разработки пропускаем проверку
            if (app()->environment('local', 'testing')) {
                return [
                    'success' => true,
                    'error' => 'Development mode - check skipped'
                ];
            }
            
            return [
                'success' => false,
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
            'secret_key_prefix' => substr($secretKey, 0, 10) . '...',
            'environment' => app()->environment()
        ]);
    }
    
    /**
     * Экстренный метод для сброса пароля (только для разработки)
     */
    public function emergencyPasswordReset(Request $request)
    {
        // Только в режиме разработки
        if (!app()->environment('local', 'testing')) {
            abort(403);
        }
        
        $request->validate([
            'email' => 'required|email|exists:clients,email',
            'new_password' => 'required|string|min:8'
        ]);
        
        $client = Client::where('email', $request->email)->first();
        $client->password = Hash::make($request->new_password);
        $client->save();
        
        Log::warning('Emergency password reset', ['user_id' => $client->ID_client]);
        
        return response()->json([
            'success' => true,
            'message' => 'Пароль сброшен',
            'new_password' => $request->new_password
        ]);
    }
}