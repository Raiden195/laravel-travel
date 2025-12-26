<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет - TRALALELO TRALALA</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
            
            <div style="display: flex; align-items: center; gap: 10px;">
                @auth
                    {{-- Проверка на админа (ID_role == 1) --}}
                    @if(Auth::user()->ID_role == 1)
                        <a href="{{ route('admin.dashboard') }}" class="login-button" style="margin-right: 10px;">
                            <img src="{{ asset('images/key.png') }}" alt="Админка" style="width: 20px; height: 20px;">
                            Админка
                        </a>
                    @endif
                    
                    <a href="{{ route('profile') }}" class="login-button" style="margin-right: 10px;">
                        <img src="{{ asset('images/user.png') }}" alt="Личный кабинет">
                        {{ Auth::user()->login }}
                    </a>
                    
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="logout-button">
                            <img src="{{ asset('images/logout.png') }}" alt="Выйти">
                            Выйти
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="login-button">
                        <img src="{{ asset('images/user.png') }}" alt="Войти">
                        Войти
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <main class="profile-container">
        <div class="profile-sidebar">
            <div class="user-info">
                <div class="avatar">
                    <i class="fas fa-user-circle"></i>
                </div>
                <h3>{{ $user->name ?? $user->login }}</h3>
                <p>{{ $user->email ?? 'Email не указан' }}</p>
                <div class="user-status">
                    @if($user->ID_role == 1)
                        <span class="status-badge admin">Администратор</span>
                    @else
                        <span class="status-badge user">Пользователь</span>
                    @endif
                </div>
            </div>
            
            <nav class="profile-menu">
                <a href="{{ route('profile') }}" class="menu-item active">
                    <i class="fas fa-home"></i> Обзор
                </a>
                <a href="{{ route('profile.bookings') }}" class="menu-item">
                    <i class="fas fa-suitcase"></i> Мои бронирования
                </a>
                <a href="{{ route('profile.settings') }}" class="menu-item">
                    <i class="fas fa-cog"></i> Настройки
                </a>
                <a href="{{ route('two-factor.enable.form') }}" class="menu-item">
                    <i class="fas fa-shield-alt"></i> Безопасность
                </a>
                <a href="{{ route('profile.favorites') }}" class="menu-item">
                    <i class="fas fa-heart"></i> Избранное
                </a>
            </nav>
        </div>
        
        <div class="profile-content">
            <div class="welcome-section">
                <h1>Добро пожаловать в личный кабинет!</h1>
                <p>Здесь вы можете управлять своими бронированиями, настройками и безопасностью аккаунта.</p>
            </div>
            
            <div class="stats-section">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-suitcase"></i>
                    </div>
                    <div class="stat-info">
                        <h3>0</h3>
                        <p>Активные бронирования</p>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-history"></i>
                    </div>
                    <div class="stat-info">
                        <h3>0</h3>
                        <p>Завершенные поездки</p>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <div class="stat-info">
                        <h3>0</h3>
                        <p>Избранные туры</p>
                    </div>
                </div>
            </div>
            
            <div class="security-section">
                <div class="security-card">
                    <div class="security-header">
                        <h3><i class="fas fa-shield-alt"></i> Безопасность аккаунта</h3>
                    </div>
                    <div class="security-content">
                        <div class="security-item">
                            <div class="security-info">
                                <h4>Двухэтапная аутентификация</h4>
                                <p>Дополнительная защита вашего аккаунта</p>
                            </div>
                            <div class="security-action">
                                @if($user->is_2fa_enabled ?? false)
                                    <span class="badge enabled">Включена</span>
                                    <form action="{{ route('two-factor.disable') }}" method="POST" class="inline-form">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            Отключить
                                        </button>
                                    </form>
                                @else
                                    <span class="badge disabled">Отключена</span>
                                    <a href="{{ route('two-factor.enable.form') }}" class="btn btn-sm btn-primary">
                                        Включить
                                    </a>
                                @endif
                            </div>
                        </div>
                        
                        <div class="security-item">
                            <div class="security-info">
                                <h4>Смена пароля</h4>
                                <p>Рекомендуем менять пароль регулярно</p>
                            </div>
                            <div class="security-action">
                                <a href="{{ route('password.change') }}" class="btn btn-sm btn-outline-secondary">
                                    Сменить пароль
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="quick-actions">
                <h3>Быстрые действия</h3>
                <div class="actions-grid">
                    <a href="{{ route('tour') }}" class="action-card">
                        <i class="fas fa-search"></i>
                        <span>Найти тур</span>
                    </a>
                    <a href="{{ route('hottour') }}" class="action-card">
                        <i class="fas fa-fire"></i>
                        <span>Горящие туры</span>
                    </a>
                    <a href="{{ route('contact') }}" class="action-card">
                        <i class="fas fa-headset"></i>
                        <span>Поддержка</span>
                    </a>
                </div>
            </div>
        </div>
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

    <script>
        // Активация меню
        document.addEventListener('DOMContentLoaded', function() {
            const menuItems = document.querySelectorAll('.menu-item');
            menuItems.forEach(item => {
                item.addEventListener('click', function() {
                    menuItems.forEach(i => i.classList.remove('active'));
                    this.classList.add('active');
                });
            });
        });
    </script>
</body>
</html>