<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Требуется активация - TRALALELO TRALALA</title>
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
                    <h1>Требуется активация аккаунта</h1>
                    
                    <div class="alert alert-warning">
                        <p><strong>Ваш аккаунт не активирован!</strong></p>
                        <p>Для входа в систему необходимо активировать ваш аккаунт.</p>
                    </div>
                    
                    <div class="activation-info">
                        <p>Мы отправили письмо с ссылкой активации на адрес:</p>
                        <div class="email-box">
                            <strong>{{ Auth::check() ? Auth::user()->email : 'вашу почту' }}</strong>
                        </div>
                    </div>
                    
                    <div class="resend-form">
                        <p><strong>Не получили письмо?</strong></p>
                        <p>Проверьте папку "Спам" или запросите новую ссылку:</p>
                        
                        <form method="POST" action="{{ route('activation.resend') }}">
                            @csrf
                            <div class="input-group">
                                <input type="email" id="email" name="email" 
                                       placeholder="Введите ваш email" 
                                       value="{{ old('email', Auth::check() ? Auth::user()->email : '') }}"
                                       required>
                                @error('email')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <button type="submit" class="btn" style="background-color: #ffc107; color: #000;">
                                Отправить ссылку активации повторно
                            </button>
                        </form>
                    </div>
                    
                    <div class="tips">
                        <p><strong>Советы:</strong></p>
                        <ul>
                            <li>Проверьте папку "Спам" или "Рассылки"</li>
                            <li>Ссылка действительна 24 часа</li>
                            <li>Если письмо не пришло, запросите новую ссылку</li>
                        </ul>
                    </div>
                    
                    <div class="action-buttons">
                        <a href="{{ route('login') }}" class="btn" style="background-color: #6c757d;">
                            Вернуться к входу
                        </a>
                        
                        @if(Auth::check())
                        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn" style="background-color: #dc3545;">
                                Выйти
                            </button>
                        </form>
                        @endif
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
</body>
</html>