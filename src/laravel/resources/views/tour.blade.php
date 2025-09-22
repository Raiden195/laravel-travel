<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Поиск туров - TRALALELO TRALALA</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <header>
        <div class="header-container">
            <div class="name">TRALALELO TRALALA</div>
            <nav>
                <ul>
                    <li><a href="{{ route('main') }}">Главная</a></li>
                    <li><a href="{{ route('hottour') }}">Горящие туры</a></li>
                    <li><a href="{{ route('tour') }}" class="active">Поиск туров</a></li>
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

    <main>
        <section class="search-section">
            <h2>Найти туры</h2>
            <div class="filter-form">
                <div class="search-form3">
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
                               placeholder="Период отправления" id="dateRangePickerSearch" />
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
                </div>

                <div class="filter-row blue-row">
                    <div class="filter-item">
                        <div class="star-rating">
                            <div>Класс отеля</div>
                            <span class="fa fa-star star" data-rating="1"></span>
                            <span class="fa fa-star star" data-rating="2"></span>
                            <span class="fa fa-star star" data-rating="3"></span>
                            <span class="fa fa-star star" data-rating="4"></span>
                            <span class="fa fa-star star" data-rating="5"></span>
                        </div>
                    </div>

                    <div class="filter-item">
                        <select class="food-button" type="text" placeholder="Питание">
                            <option value="" disabled selected>Питание</option>
                            <option value="any">Неважно</option>
                            <option value="yes">Есть</option>
                            <option value="no">Нет</option>
                        </select>
                    </div>

                    <div class="filter-item">
                        <select class="vacation-type-button" type="text" placeholder="Тип отдыха">
                            <option value="" disabled selected>Тип отдыха</option>
                            <option value="beach">Пляжный</option>
                            <option value="excursion">Экскурсионный</option>
                        </select>
                    </div>

                    <div class="filter-item">
                        <select class="airport-distance-button" type="text" placeholder="Расстояние до аэропорта">
                            <option value="" disabled selected>Расстояние до аэропорта</option>
                            <option value="10">Не более 10 км</option>
                            <option value="20">Не более 20 км</option>
                            <option value="30">Не более 30 км</option>
                            <option value="30plus">Более 30 км</option>
                        </select>
                    </div>

                    <div class="filter-item">
                        <select class="beach-distance-button" type="text" placeholder="Расстояние до пляжа">
                            <option value="" disabled selected>Расстояние до пляжа</option>
                            <option value="1line">1 линия</option>
                            <option value="2line">2 линия</option>
                            <option value="3line">3 линия</option>
                        </select>
                    </div>
                    
                    <div class="filter-item">
                        <button class="budget-button">Бюджет</button>
                        <div class="selected-value" id="budget-selected"></div>
                    </div>
                </div>
                <button class="submit-button">Подобрать тур</button>
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

    <div class="modal" id="budgetModal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <label for="min-budget">Минимальная стоимость:</label>
            <input type="number" id="min-budget" placeholder="Минимальная стоимость">
            <label for="max-budget">Максимальная стоимость:</label>
            <input type="number" id="max-budget" placeholder="Максимальная стоимость">
            <button class="find-button" id="find-budget">Найти</button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script src="{{ asset('js/datatours.js') }}"></script>
    <script src="{{ asset('js/starraiting.js') }}"></script>
</body>
</html>