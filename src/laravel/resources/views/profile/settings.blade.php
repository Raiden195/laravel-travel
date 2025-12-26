<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Настройки | TRALALELO TRALALA</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <!-- HEADER (скопируйте ваш header из главной страницы) -->
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

    <div class="profile-container">
        <div class="profile-header">
            <h1 class="profile-title">
                <i class="fas fa-cog"></i>
                Настройки аккаунта
            </h1>
            <a href="{{ route('profile.index') }}" class="btn-outline">
                <i class="fas fa-arrow-left"></i>
                Назад в личный кабинет
            </a>
        </div>
        
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        <div class="settings-grid">
            <!-- Настройки аккаунта -->
            <div class="settings-card">
                <h2>
                    <i class="fas fa-user-cog"></i>
                    Основные настройки
                </h2>
                
                <form action="{{ route('profile.settings.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label class="form-label">Логин</label>
                        <input type="text" name="login" class="form-control" 
                               value="{{ old('login', Auth::user()->login) }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" 
                               value="{{ old('email', Auth::user()->email) }}">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        Сохранить изменения
                    </button>
                </form>
            </div>

            <!-- Безопасность -->
            <div class="settings-card">
                <h2>
                    <i class="fas fa-shield-alt"></i>
                    Безопасность
                </h2>
                
                <!-- Смена пароля -->
                <form action="{{ route('profile.settings.password') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label class="form-label">Текущий пароль</label>
                        <input type="password" name="current_password" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Новый пароль</label>
                        <input type="password" name="new_password" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Подтвердите пароль</label>
                        <input type="password" name="new_password_confirmation" class="form-control" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-key"></i>
                        Сменить пароль
                    </button>
                </form>
                
                <!-- Двухэтапная аутентификация -->
                <div class="switch-container">
                    <div>
                        <h4>Двухэтапная аутентификация</h4>
                        <p>Дополнительная защита вашего аккаунта</p>
                    </div>
                    <label class="switch">
                        <input type="checkbox" id="twoFactorToggle" 
                               {{ Auth::user()->two_factor_enabled ? 'checked' : '' }}>
                        <span class="slider"></span>
                    </label>
                </div>
                
                @if(Auth::user()->two_factor_enabled)
                <div id="twofaSection" class="twofa-section">
                    <h4><i class="fas fa-check-circle" style="color: #AAFF00;"></i> 2FA включена</h4>
                    <p>Двухэтапная аутентификация активна. Ваш аккаунт защищен дополнительным кодом.</p>
                    
                    @if(Auth::user()->two_factor_secret)
                    <div class="qr-code">
                        <div class="qr-placeholder">
                            <i class="fas fa-qrcode"></i>
                            <p>QR-код для Google Authenticator</p>
                        </div>
                    </div>
                    
                    <div class="secret-key">
                        <strong>Секретный ключ:</strong><br>
                        {{ Auth::user()->two_factor_secret }}
                    </div>
                    @endif
                    
                    <form action="{{ route('profile.settings.disable-2fa') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-times"></i>
                            Отключить 2FA
                        </button>
                    </form>
                </div>
                @else
                <div id="twofaSection" class="twofa-section" style="display: none;">
                    <h4>Настройка 2FA</h4>
                    <p>Для включения двухэтапной аутентификации:</p>
                    <ol style="padding-left: 20px; margin-bottom: 20px;">
                        <li>Установите приложение Google Authenticator</li>
                        <li>Нажмите кнопку "Включить 2FA"</li>
                        <li>Отсканируйте QR-код в приложении</li>
                        <li>Вводите код из приложения при каждом входе</li>
                    </ol>
                    
                    <form action="{{ route('profile.settings.enable-2fa') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-shield-alt"></i>
                            Включить двухэтапную аутентификацию
                        </button>
                    </form>
                </div>
                @endif
            </div>
        </div>

        <!-- Выход из аккаунта -->
        <div class="logout-section">
            <h2><i class="fas fa-sign-out-alt"></i> Выход из аккаунта</h2>
            <p>Завершите текущий сеанс на этом устройстве. Вы сможете войти снова в любое время.</p>
            
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-sign-out-alt"></i>
                    Выйти из аккаунта
                </button>
            </form>
        </div>
    </div>

    <!-- Подключите ваш JS для выпадающего меню -->
    <script src="{{ asset('js/user-menu.js') }}"></script>
    
    <script>
        // Управление переключателем 2FA
        document.addEventListener('DOMContentLoaded', function() {
            const twoFactorToggle = document.getElementById('twoFactorToggle');
            const twofaSection = document.getElementById('twofaSection');
            
            if (twoFactorToggle) {
                twoFactorToggle.addEventListener('change', function() {
                    if (this.checked) {
                        // Показываем секцию настройки 2FA
                        if (twofaSection) {
                            twofaSection.style.display = 'block';
                        }
                    } else {
                        // Скрываем секцию настройки 2FA
                        if (twofaSection) {
                            twofaSection.style.display = 'none';
                        }
                    }
                });
                
                // Инициализируем видимость секции при загрузке
                if (twofaSection && {{ Auth::user()->two_factor_enabled ? 'true' : 'false' }}) {
                    twofaSection.style.display = 'block';
                }
            }
        });
    </script>
</body>
</html>