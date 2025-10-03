<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация - TRALALELO TRALALA</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    
 
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    <header>
        <div class="header-container">
            <div class="name">TRALALELO TRALALA</div>
            <nav>
                <ul>
                    <li><a href="{{ route('main') }}">Главная</a></li>
                    <li><a href="{{ route('hottour') }}">Горящие туры</a></li>
                    <li><a href="{{ route('tour') }}">Поиск туров</a></li>
                    <li><a href="{{ route('about') }}">О нас</a></li>
                    <li><a href="{{ route('contact') }}">Контакты</a></li>
                </ul>
            </nav>
            
            @auth
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="login-button" style="background: none; border: none; color: inherit; cursor: pointer; font: inherit; display: flex; align-items: center;">
                        <img src="{{ asset('images/user.png') }}" alt="Выйти">
                        Выйти ({{ Auth::user()->login }})
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="login-button">
                    <img src="{{ asset('images/user.png') }}" alt="Войти">
                    Войти
                </a>
            @endauth
        </div>
    </header>
    
    <div class="auth-container-vse">
        <img class="background-image" src="{{ asset('images/auth.png') }}" alt="Фон авторизации">
        
        <div class="auth-container">
            <div class="auth-form-section">
                <div class="auth-form-wrapper">
                    <h1>Авторизация</h1>
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('login.post') }}" id="authForm">
                        @csrf
                        <div class="input-group">
                            <input type="text" id="login" name="login" placeholder="Логин или Email" required value="{{ old('login') }}">
                            @error('login')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-group">
                            <input type="password" id="password" name="password" placeholder="Пароль" required>
                            @error('password')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        
                      
                        <div class="input-group">
                            <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                            @error('g-recaptcha-response')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <button type="submit" class="btn" id="submitBtn">Войти</button>
                    </form>
                    <div class="register-links">
                        <p>Еще нет аккаунта?</p>
                        <a href="{{ route('register') }}" id="registerLink">Регистрация</a>
                    </div>
                </div>
            </div>
            
            <div class="logo-section">
                <div class="logo-placeholder">
                    <span><img src="{{ asset('images/logo.png') }}" alt="Логотип"></span>
                </div>
            </div>
        </div>
    </div>

    <footer class="auth-footer">
        <div class="footer-container">
            <div class="footer-logo">TRALALELO TRALALA</div>
            <div class="footer-nav">
                <a href="{{ route('about') }}">О нас</a>
                <a href="{{ route('contact') }}">Контакты</a>
                <a href="{{ route('tour') }}">Поиск туров</a>
            </div>
            <div class="social-icons">
                <a href="#"><img src="{{ asset('images/vk.png') }}" alt="VK"></a>
                <a href="#"><img src="{{ asset('images/tg.png') }}" alt="Telegram"></a>
                <a href="#"><img src="{{ asset('images/insta.png') }}" alt="Instagram"></a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    
    <!-- ДОБАВЛЕНО: JavaScript для проверки reCAPTCHA -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('authForm');
            const submitBtn = document.getElementById('submitBtn');
            
            // Проверка reCAPTCHA перед отправкой формы
            form.addEventListener('submit', function(e) {
                const recaptchaResponse = grecaptcha.getResponse();
                
                if (recaptchaResponse.length === 0) {
                    e.preventDefault();
                    alert('Пожалуйста, подтвердите, что вы не робот!');
                    return false;
                }
            });
            
            // Дополнительная валидация формы
            const loginInput = document.getElementById('login');
            const passwordInput = document.getElementById('password');
            
            function validateForm() {
                if (loginInput.value.trim() === '' || passwordInput.value.trim() === '') {
                    submitBtn.disabled = true;
                    submitBtn.style.opacity = '0.6';
                    return false;
                } else {
                    submitBtn.disabled = false;
                    submitBtn.style.opacity = '1';
                    return true;
                }
            }
            
            loginInput.addEventListener('input', validateForm);
            passwordInput.addEventListener('input', validateForm);
            
            // Инициализация проверки при загрузке
            validateForm();
        });
    </script>
</body>
</html>