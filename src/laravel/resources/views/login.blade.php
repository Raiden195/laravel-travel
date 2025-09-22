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
</head>
<body>
    <header>
        <div class="header-container">
            <div class="name">TRALALELO TRALALA</div>
            <nav>
                <ul>
                    <li><a href="{{ route('main') }}">Главная</a></li>
                    <li><a href="{{ route('hottour') }}">Горящие туры</a></li>
                    <li><a href="{{ route('tour') }}">Поиск туры</a></li>
                    <li><a href="{{ route('about') }}">О нас</a></li>
                    <li><a href="{{ route('contact') }}">Контакты</a></li>
                </ul>
            </nav>
            <a href="{{ route('login') }}" class="login-button">
                <img src="{{ asset('images/user.png') }}" alt="Войти">
                Войти
            </a>
        </div>
    </header>
    
    <div class="auth-container-vse">
        <img class="background-image" src="{{ asset('images/auth.png') }}" alt="Фон авторизации">
        
        <div class="auth-container">
            <div class="auth-form-section">
                <div class="auth-form-wrapper">
                    <h1>Авторизация</h1>
                    <form id="loginForm">
                        <div class="input-group">
                            <input type="text" id="login" name="login" placeholder="Логин" required>
                        </div>
                        <div class="input-group">
                            <input type="password" id="password" name="password" placeholder="Пароль" required>
                        </div>
                        <button type="submit" class="btn">Войти</button>
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

    <script src="{{ asset('js/script.js') }}"></script>
      <script src="{{ asset('js/loginscript.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
   
</body>
</html>