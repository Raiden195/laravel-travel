<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRALALELO TRALALA</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            
            <div style="display: flex; align-items: center; gap: 10px;">
                @auth
                    {{-- Проверка на админа (ID_role == 1) --}}
                    @if(Auth::user()->ID_role == 1)
                        <a href="{{ route('admin.dashboard') }}" class="admin-button">
                            <i class="fas fa-cog"></i>
                            Админка
                        </a>
                    @endif
                    
                    <!-- Выпадающее меню пользователя -->
                    <div class="user-dropdown">
                        <button class="user-dropdown-toggle">
                            <img src="{{ asset('images/user.png') }}" alt="Войти">
                            {{ Auth::user()->login }}
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        
                        <div class="user-dropdown-menu">
                            <a href="{{ route('profile.index') }}" class="dropdown-item">
                                <i class="fas fa-home"></i>
                                Личный кабинет
                            </a>
                            <a href="{{ route('profile.profile') }}" class="dropdown-item">
                                <i class="fas fa-user"></i>
                                Мой профиль
                            </a>
                            <a href="{{ route('profile.favorites') }}" class="dropdown-item">
                                <i class="fas fa-heart"></i>
                                Избранное
                            </a>
                            <a href="{{ route('profile.booking') }}" class="dropdown-item">
                                <i class="fas fa-calendar-alt"></i>
                                Мои бронирования
                            </a>
                            <a href="{{ route('profile.settings') }}" class="dropdown-item">
                                <i class="fas fa-cog"></i>
                                Настройки
                            </a>
                            <div class="dropdown-divider"></div>
                            <form action="{{ route('logout') }}" method="POST" class="dropdown-logout-form">
                                @csrf
                                <button type="submit" class="dropdown-item logout-btn">
                                    <i class="fas fa-sign-out-alt"></i>
                                    Выйти
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Для неавторизованных пользователей -->
                    <a href="{{ route('login') }}" class="login-button">
                        <img src="{{ asset('images/user.png') }}" alt="Войти">
                        Войти
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <img class="home-img" src="{{ asset('images/mainpage1.jpg') }}" alt="" width="1920" height="970">
    <section class="hero">
        <div class="hero-content">
            <div class="conteer-home">
                <h1 class="title-home">Один билет — <br> много эмоций</h1>
                <p class="subtitle-home">Создай свою уникальную историю <br>с каждым новым путешествием</p>
            </div>
        </div>
        <div class="search-form">
            <select class="otkyda3" type="text" placeholder="Откуда">
                <option value="" disabled selected>Откуда</option>
                <option value="Moscow">Москва</option>
                <option value="SPeterburg">Санкт-Петербург</option>
                <option value="Kazan">Казань</option>
                <option value="Ekaterinburg">Екатеринбург</option>
                <option value="Novosibirsk">Новосибирск</option>
                <option value="Krasnodar">Краснодар</option>
                <option value="Sochi">Сочи</option>
                <option value="Vladivostok">Владивосток</option>
                <option value="Ircutsck">Иркутск</option>
                <option value="NNovgorod">Нижний Новгород</option>
            </select>

            <select class="kyda3" type="text" placeholder="Куда">
                <option value="" disabled selected>Куда</option>
                <option value="Turkey">Турция</option>
                <option value="Egypt">Египет</option>
                <option value="Thailand">Таиланд</option>
                <option value="Spain">Испания</option>
                <option value="Italy">Италия</option>
                <option value="Greece">Греция</option>
                <option value="Cyprus">Кипр</option>
                <option value="UAE">ОАЭ</option>
                <option value="Maldives">Мальдивы</option>
                <option value="Indonesia">Индонезия</option>
            </select>
            
            <div class="date-picker">
                <input class="time" type="text" name="daterange" value="" 
                       placeholder="Период отправления" id="dateRangePickerHome" />
            </div>
            
            <select class="night3" type="text" placeholder="Количество ночей">
                <option value="" disabled selected>Количество ночей</option>
                <option value="1">1 ночь</option>
                <option value="2">2 ночи</option>
                <option value="3">3 ночи</option>
                <option value="4">4 ночи</option>
                <option value="5">5 ночей</option>
                <option value="6">6 ночей</option>
                <option value="7">7 ночей</option>
                <option value="10">10 ночей</option>
                <option value="14">14 ночей</option>
                <option value="more">более 14 ночей</option>
            </select>

            <select class="tyrist3" type="text" placeholder="Туристы">
                <option value="" disabled selected>Туристы</option>
                <option value="1">1 турист</option>
                <option value="2">2 туриста</option>
                <option value="group">Группа</option>
                <option value="family">Семья</option>
                <option value="other">Другое</option>
            </select>
            
            <a href="{{ route('tour') }}" class="search-button">
                <img src="{{ asset('images/search.png') }}" alt="Поиск">
            </a>
        </div>
    </section>

    <section class="about">
        <div class="about-text">
            <p>TRALALELO TRALALA - это доступные путешествия в любую точку мира! Мы предлагаем широкий выбор туров на любой бюджет, от экономичных вариантов до эксклюзивных предложений. Наша команда поможет вам подобрать идеальный тур, который будет соответствовать вашим возможностям и желаниям.</p>
            <a href="{{ route('tour') }}" class="tour-button-main">Выбрать тур</a>
        </div>
        <div class="about-image">
            <img src="{{ asset('images/главная 2.png') }}" alt="Описание">
        </div>
    </section>

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

    <script src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script src="{{ asset('js/datamaon.js') }}"></script>
    <script src="{{ asset('js/user-menu.js') }}"></script>
</body>
</html>