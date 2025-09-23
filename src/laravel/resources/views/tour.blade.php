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

        <div class="container-tour-card">
    <div class="row">
        @php
            $tours = [
                [
                    'image' => 'images/turkey.png',
                    'rating' => '⭐⭐⭐⭐☆',
                    'title' => 'Sunny Shore Resort',
                    'country' => 'Турция',
                    'icons_color' => 'green',
                    'price' => '117 000'
                ],
                [
                    'image' => 'images/tai.png',
                    'rating' => '⭐⭐⭐⭐☆',
                    'title' => 'Fairy Cliff Retreat',
                    'country' => 'Таиланд',
                    'icons_color' => 'pink',
                    'price' => '217 000'
                ],
                [
                    'image' => 'images/maldiv.png',
                    'rating' => '⭐⭐⭐⭐⭐',
                    'title' => 'Dream Rock Villas',
                    'country' => 'Мальдивы',
                    'icons_color' => 'green',
                    'price' => '557 000'
                ],
                [
                    'image' => 'images/kipr.png',
                    'rating' => '⭐⭐⭐☆☆',
                    'title' => 'Starry Comfort Boutique',
                    'country' => 'Кипр',
                    'icons_color' => 'pink',
                    'price' => '397 000'
                ],
                [
                    'image' => 'images/greece.png',
                    'rating' => '⭐⭐⭐⭐⭐',
                    'title' => 'Enchanted Forest Lodge',
                    'country' => 'Греция',
                    'icons_color' => 'green',
                    'price' => '250 000'
                ],
                [
                    'image' => 'images/indones.png',
                    'rating' => '⭐☆☆☆☆',
                    'title' => 'Crystal Spring Spa',
                    'country' => 'Индонезия',
                    'icons_color' => 'pink',
                    'price' => '97 000'
                ]
            ];
        @endphp

        @foreach($tours as $tour)
        <div class="tour-card">
            <img src="{{ $tour['image'] }}" alt="Тур">
            <div class="rating">{{ $tour['rating'] }}</div>
            <div class="title-tour">{{ $tour['title'] }}</div>
            <div class="country">{{ $tour['country'] }}</div>
            <div class="icons">
                <div>
                    <span class="icon-container">
                        <span class="icon-wrapper blue"><img src="images/food.png" alt="all" title="Питание"></span> All
                    </span>
                    <span class="icon-container">
                        <span class="icon-wrapper blue"><img src="images/plane.png" alt="plane" title="Расстояние от аэропорта"></span> 5 км
                    </span>
                    <span class="icon-container">
                        <span class="icon-wrapper blue"><img src="images/beach.png" alt="sea" title="Расстояние от пляжа"></span> 1 км
                    </span>
                </div>
                <div> 
                    <span class="icon-wrapper {{ $tour['icons_color'] }}"><img src="images/transfer.png" alt="bus" title="Трансфер включен"></span>
                    <span class="icon-wrapper {{ $tour['icons_color'] }}"><img src="images/plane.png" alt="fly" title="Перелет включен"></span>
                    <span class="icon-wrapper {{ $tour['icons_color'] }}"><img src="images/hostel.png" alt="house" title="Проживание включено"></span>
                    <span class="icon-wrapper {{ $tour['icons_color'] }}">
                        <img src="images/{{ $tour['icons_color'] == 'green' ? 'beach-chil' : 'escur' }}.png" alt="circle2" title="Экскурсионный тур">
                    </span>
                </div>
            </div>
            <div class="price">от {{ $tour['price'] }} РУБ</div>
            <button class="tour-button">Выбрать</button>
        </div>
        @endforeach
    </div>
</div>

<div id="bookingModal" class="modal">
    <div class="modal-content">
        <span class="close-button">&times;</span>
        <h2>Бронирование тура</h2>
        <p>Заполните форму</p>
        <form id="bookingForm">
            <input type="text" placeholder="Фамилия" required>
            <input type="text" placeholder="Имя" required>
            <input type="text" placeholder="Отчество">
            <input type="text" placeholder="Серия паспорта" required>
            <input type="text" placeholder="Номер паспорта" required>
            <input type="text" placeholder="Кем выдан" required>
            <input type="date" placeholder="Когда выдан" required>
            <button class="book-button">Забронировать</button>
            <button class="add-passenger-button">Добавить еще пассажира</button>
        </form>
    </div>
</div>

<script src="bookingscript.js"></script>



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