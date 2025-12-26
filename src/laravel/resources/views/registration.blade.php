<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
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
                <a href="{{ route('logout') }}" class="login-button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <img src="{{ asset('images/user.png') }}" alt="Выйти">
                    Выйти ({{ Auth::user()->login }})
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @else
                <a href="{{ route('login') }}" class="login-button">
                    <img src="{{ asset('images/user.png') }}" alt="Войти">
                    Войти
                </a>
            @endauth
        </div>
    </header>
    
    <img src="{{ asset('images/auth.png') }}" alt="Фон" class="background-image">
    
    <div class="reg-container">
        <div class="reg-form-section">
            <div class="reg-form-wrapper">
                <h1>Регистрация</h1>
                
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                


@if(session('success') && (str_contains(session('success'), 'активации') || str_contains(session('success'), 'Проверьте')))
    <div class="alert alert-info">
        <strong>Регистрация успешна!</strong><br>
        {{ session('success') }}<br><br>
        <small>Проверьте папку "Спам", если не видите письмо.</small>
    </div>
@endif

                <form method="POST" action="{{ route('register.post') }}">
                    @csrf
                    <div class="input-group">
                        <input type="text" id="username" name="username" placeholder="Логин" required value="{{ old('username') }}" maxlength="50">
                        @error('username')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-group">
                        <input type="email" id="email" name="email" placeholder="Почта" required value="{{ old('email') }}" maxlength="100">
                        @error('email')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-group">
                        <input type="tel" id="phone" name="phone" placeholder="Телефон" required value="{{ old('phone') }}" maxlength="20">
                        @error('phone')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-group">
                        <input type="password" id="password" name="password" placeholder="Пароль" required maxlength="30">
                        @error('password')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-group">
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Повторите пароль" required maxlength="30">
                    </div>
                    <button type="submit" class="btn">Зарегистрироваться</button>
                </form>
                <div class="login-links">
                    <p>Уже есть аккаунт?</p>
                    <a href="{{ route('login') }}" id="loginLink">Войти</a>
                </div>
            </div>
        </div>
        
        <div class="logo-section">
            <div class="logo-placeholder">
                <span><img src="{{ asset('images/logo.png') }}" alt=""></span>
            </div>
        </div>
    </div>

    <footer>
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

    <script src="{{ asset('js/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
</body>
</html>