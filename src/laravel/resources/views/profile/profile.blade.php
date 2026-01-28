<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мой профиль | TRALALELO TRALALA</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .profile-container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 0 20px;
            min-height: 60vh;
        }
        
        .profile-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .profile-title {
            font-size: 32px;
            color: #333;
        }
        
        .profile-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
        }
        
        .avatar-section {
            display: flex;
            align-items: center;
            gap: 30px;
            margin-bottom: 30px;
            padding-bottom: 30px;
            border-bottom: 1px solid #eee;
        }
        
        .avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 48px;
            font-weight: 600;
        }
        
        .avatar-info h3 {
            font-size: 24px;
            margin-bottom: 5px;
            color: #333;
        }
        
        .avatar-info p {
            color: #666;
            margin-bottom: 15px;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #333;
        }
        
        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
        }
        
        .btn-primary {
            background: #007bff;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background: #0056b3;
            transform: translateY(-2px);
        }
        
        .btn-outline {
            background: white;
            color: #007bff;
            border: 2px solid #007bff;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }
        
        .btn-outline:hover {
            background: #007bff;
            color: white;
        }
        
        .alert {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
    </style>
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
                    @if(Auth::user()->ID_role == 1)
                        <a href="{{ route('admin.dashboard') }}" class="admin-button">
                            <i class="fas fa-cog"></i>
                            Админка
                        </a>
                    @endif
                    
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
                    <a href="{{ route('login') }}" class="login-button">
                        <img src="{{ asset('images/user.png') }}" alt="Войти">
                        Войти
                    </a>
                @endauth
            </div>
        </div>
    </header>
    
    <!-- Основное содержимое -->
    <main>
        <div class="profile-container">
            <div class="profile-header">
                <h1 class="profile-title">Мой профиль</h1>
                <a href="{{ route('profile.index') }}" class="btn-outline">
                    <i class="fas fa-arrow-left"></i> Назад
                </a>
            </div>
            
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif
            
            <div class="profile-card">
                <div class="avatar-section">
                    <div class="avatar">
                        {{ strtoupper(substr(Auth::user()->login, 0, 1)) }}
                    </div>
                    <div class="avatar-info">
                        <h3>{{ Auth::user()->name ?? Auth::user()->login }}</h3>
                        <p>{{ Auth::user()->email ?? 'Email не указан' }}</p>
                        <button class="btn-outline">
                            <i class="fas fa-camera"></i> Сменить аватар
                        </button>
                    </div>
                </div>
                
                <form action="{{ route('profile.profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label class="form-label">Имя</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', Auth::user()->name) }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', Auth::user()->email) }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Телефон</label>
                        <input type="tel" name="phone" class="form-control" value="{{ old('phone', Auth::user()->phone) }}">
                    </div>
                    
                    <button type="submit" class="btn-primary">
                        <i class="fas fa-save"></i> Сохранить изменения
                    </button>
                </form>
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

    <script src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script src="{{ asset('js/datamaon.js') }}"></script>
    <script src="{{ asset('js/user-menu.js') }}"></script>
    
    <script>
        // Мобильное меню
        document.querySelector('.mobile-menu-btn').addEventListener('click', function() {
            document.querySelector('.nav-links').classList.toggle('active');
        });
        
        // Раскрывающееся меню пользователя
        const userLink = document.querySelector('.user-link');
        if (userLink) {
            userLink.addEventListener('click', function(e) {
                e.preventDefault();
                this.nextElementSibling.classList.toggle('active');
            });
        }
        
        // Закрытие меню при клике вне его
        document.addEventListener('click', function(e) {
            const userMenu = document.querySelector('.user-menu');
            if (userMenu && !userMenu.contains(e.target)) {
                userMenu.querySelector('.user-dropdown').classList.remove('active');
            }
            
            if (!document.querySelector('.mobile-menu-btn').contains(e.target) && 
                !document.querySelector('.nav-links').contains(e.target)) {
                document.querySelector('.nav-links').classList.remove('active');
            }
        });
    </script>
    
</body>
</html>