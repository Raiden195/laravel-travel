<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>О нас - TRALALELO TRALALA</title>
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
                    <li><a href="{{ route('about') }}" class="active">О нас</a></li>
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
        <section class="hero-about">
            <div class="hero-about-content">
                <h1>TRALALELO TRALALA: Ваша история путешествий начинается здесь</h1>
            </div>
            <div class="hero-about-image">
                <img src="{{ asset('images/onas1.png') }}" alt="Большая картинка">
            </div>
        </section>

        <section class="story-section">
            <div class="story-text">
                <p>TRALALA была создана из мечты о доступных и запоминающихся путешествиях для каждого. Наша команда – это группа единомышленников, увлеченных миром и готовых делиться своей страстью с вами</p>
            </div>
            <div class="story-images">
                <img src="{{ asset('images/onas2.png') }}" alt="Описание 1">
                <img src="{{ asset('images/onas3.png') }}" alt="Описание 2">
                <img src="{{ asset('images/onas4.png') }}" alt="Описание 3">
                <img src="{{ asset('images/onas5.png') }}" alt="Описание 4">
            </div>
        </section>

        <section class="mission-section">
            <div class="mission-text">
                <p>Мы верим, что путешествия – это не просто отдых, а возможность узнать себя, расширить горизонты и создавать незабываемые воспоминания. Наша миссия – сделать мир ближе и доступнее, предлагая индивидуальные туры, надежные услуги и незабываемые впечатления</p>
            </div>
            <div class="mission-images">
                <img src="{{ asset('images/onas6.png') }}" alt="Описание 1">
                <img src="{{ asset('images/onas7.png') }}" alt="Описание 2">
                <img src="{{ asset('images/onas8.png') }}" alt="Описание 3">
            </div>
        </section>

        <section class="team-section">
            <h2>Команда мечты TRALALELO TRALALA</h2>
            <p>За каждым успешным путешествием стоит команда экспертов, которые любят свою работу и знают о мире туризма</p>
            <div class="team-grid">
                <div class="team-member">
                    <img src="{{ asset('images/sotrudnik1.png') }}" alt="Фото Михаила">
                    <p>Михаил</p>
                    <span>Трансферный гид</span>
                </div>
                <div class="team-member">
                    <img src="{{ asset('images/sotrudnik2.png') }}" alt="Фото Марии">
                    <p>Мария</p>
                    <span>Исторический гид</span>
                </div>
                <div class="team-member">
                    <img src="{{ asset('images/sotrudnik3.png') }}" alt="Фото Анны">
                    <p>Анна</p>
                    <span>Менеджер</span>
                </div>
                <div class="team-member">
                    <img src="{{ asset('images/sotrudnik4.png') }}" alt="Фото Константина">
                    <p>Константин</p>
                    <span>Коммерческий директор</span>
                </div>
                <div class="team-member">
                    <img src="{{ asset('images/sotrudnik5.png') }}" alt="Фото Александра">
                    <p>Александр</p>
                    <span>Генеральный директор</span>
                </div>
            </div>
        </section>

        <section class="booking-instruction-section">
            <h2>Планировать путешествие с TRALALELO TRALALA легко!</h2>
            <div class="booking-steps">
                <div class="step">
                    <div class="step-image">
                        <img src="" alt="Изучите наши предложения">
                    </div>
                    <div class="step-text">
                        <h3>Изучите наши предложения на сайте или свяжитесь с нашим менеджером для индивидуального подбора тура</h3>
                    </div>
                </div>

                <div class="step reversed">
                    <div class="step-image">
                        <img src="" alt="Заполните форму или позвоните">
                    </div>
                    <div class="step-text">
                        <h3>Заполните форму на сайте или позвоните нам по телефону, чтобы рассказать о своих пожеланиях</h3>
                    </div>
                </div>

                <div class="step">
                    <div class="step-image">
                        <img src="" alt="Наш менеджер свяжется с вами">
                    </div>
                    <div class="step-text">
                        <h3>Наш менеджер свяжется с вами, чтобы обсудить детали поездки, ответить на ваши вопросы и предложить лучшие варианты</h3>
                    </div>
                </div>

                <div class="step reversed">
                    <div class="step-image">
                        <img src="" alt="Оформление бронирования">
                    </div>
                    <div class="step-text">
                        <h3>После согласования всех деталей мы оформим бронирование и предоставим вам все необходимые документы</h3>
                    </div>
                </div>

                <div class="step">
                    <div class="step-image">
                        <img src="" alt="Собирайте чемодан">
                    </div>
                    <div class="step-text">
                        <h3>С TRALALELO TRALALA вам остается только собрать чемодан и отправиться навстречу новым приключениям!</h3>
                    </div>
                </div>
            </div>
        </section>

        <section class="reviews-section">
            <h2>Что говорят о TRALALELO TRALALA наши путешественники?</h2>
            <div class="reviews-container">
                <div class="review">
                    <div class="review-author">
                        <img src="{{ asset('images/otzuv1.png') }}" alt="Елена">
                        <div class="author-info">
                            <h3>Елена</h3>
                            <div class="rating-stars">★★★★★</div>
                        </div>
                    </div>
                    <p>Мне очень понравилось путешествие, организованное tralalelelo tralala! Всё было продумано до мелочей, и я смогла полностью расслабиться и наслаждаться отдыхом!</p>
                </div>
                <div class="review">
                    <div class="review-author">
                        <img src="{{ asset('images/otzuv2.png') }}" alt="София">
                        <div class="author-info">
                            <h3>София</h3>
                            <div class="rating-stars">★★★★★</div>
                        </div>
                    </div>
                    <p>Впервые не пришлось ни о чем волноваться в поездке. Каждая деталь была продумана. Полностью расслабилась и получила море удовольствия!</p>
                </div>
                <div class="review">
                    <div class="review-author">
                        <img src="{{ asset('images/otzuv3.png') }}" alt="Дмитрий">
                        <div class="author-info">
                            <h3>Дмитрий</h3>
                            <div class="rating-stars">★★★★★</div>
                        </div>
                    </div>
                    <p>Крутая организация! От трансферов до экскурсий — всё работало как часы. Чувствовал заботу на каждом шагу. Супер!</p>
                </div>
                <div class="review">
                    <div class="review-author">
                        <img src="{{ asset('images/otzuv4.png') }}" alt="Андрей">
                        <div class="author-info">
                            <h3>Андрей</h3>
                            <div class="rating-stars">★★★★★</div>
                        </div>
                    </div>
                    <p>Всё чётко, без задержек и сюрпризов. Максимум отдыха и минимум забот. Редкое качество сервиса. Буду рекомендовать</p>
                </div>
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