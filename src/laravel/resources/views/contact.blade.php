<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Контакты - TRALALELO TRALALA</title>
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
                <li><a href="{{ route('main') }}" class="active">Главная</a></li>
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

    <main>
        <section class="contact-section">
            <div class="contact-content">
                <h2>Свяжитесь с нами</h2>
                <p>Мы всегда готовы помочь вам с организацией вашего путешествия. Оставьте нам сообщение или свяжитесь с нами по телефону или электронной почте.</p>
            </div>
            <div class="contact-info">
                <div class="contact-item">
                    <img src="{{ asset('images/phone.png') }}" alt="Телефон">
                    <p>+7 (123) 456-78-90</p>
                </div>
                <div class="contact-item">
                    <img src="{{ asset('images/email.png') }}" alt="Почта">
                    <p>info@tralalelotravala.com</p>
                </div>
            </div>
            <div class="contact-map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2245.372789924243!2d37.61729931593047!3d55.755826680552!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46b54a5a738fa419%3A0x7c347d506f527151!2z0JrRgNCw0YHQvdCw0Y8g0J_Qu9C-0YnQsNC00Yw!5e0!3m2!1sru!2sru!4v1633955353557!5m2!1sru!2sru" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </section>
    </main>

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
</body>
</html>