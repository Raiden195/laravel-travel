<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет | TRALALELO TRALALA</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .profile-container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
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
            margin-bottom: 10px;
        }
        
        .profile-subtitle {
            color: #666;
            font-size: 16px;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            text-align: center;
            transition: transform 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .stat-icon {
            font-size: 40px;
            margin-bottom: 15px;
            color: #007bff;
        }
        
        .stat-number {
            font-size: 36px;
            font-weight: 700;
            color: #333;
            margin-bottom: 10px;
        }
        
        .stat-label {
            color: #666;
            font-size: 16px;
        }
        
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 30px;
        }
        
        .action-button {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 20px;
            background: white;
            border-radius: 10px;
            text-decoration: none;
            color: #333;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }
        
        .action-button:hover {
            background: #007bff;
            color: white;
            transform: translateY(-3px);
        }
        
        .action-button:hover .action-icon {
            color: white;
        }
        
        .action-icon {
            font-size: 24px;
            color: #007bff;
        }
        
        .action-text {
            font-weight: 500;
        }
        
        .welcome-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
        }
        
        .welcome-title {
            font-size: 28px;
            margin-bottom: 10px;
        }
        
        .welcome-text {
            font-size: 16px;
            opacity: 0.9;
        }
    </style>
</head>
<body>
    @include('partials.header')
    
    <div class="profile-container">
        <div class="profile-header">
            <div>
                <h1 class="profile-title">Личный кабинет</h1>
                <p class="profile-subtitle">Добро пожаловать, {{ Auth::user()->name ?? Auth::user()->login }}!</p>
            </div>
            <div>
                <a href="{{ route('tour') }}" class="btn" style="background: #007bff; color: white; padding: 12px 24px; border-radius: 25px; text-decoration: none;">
                    <i class="fas fa-search"></i> Найти туры
                </a>
            </div>
        </div>
        
        <div class="welcome-card">
            <h2 class="welcome-title">TRALALELO TRALALA</h2>
            <p class="welcome-text">Ваш персональный помощник в мире путешествий</p>
        </div>
        
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <div class="stat-number">0</div>
                <div class="stat-label">Активных бронирований</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-heart"></i>
                </div>
                <div class="stat-number">0</div>
                <div class="stat-label">Избранных туров</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-plane"></i>
                </div>
                <div class="stat-number">0</div>
                <div class="stat-label">Завершенных поездок</div>
            </div>
        </div>
        
        <h2 style="margin: 40px 0 20px 0; color: #333;">Быстрые действия</h2>
        <div class="quick-actions">
            <a href="{{ route('profile.profile') }}" class="action-button">
                <div class="action-icon">
                    <i class="fas fa-user"></i>
                </div>
                <div class="action-text">Мой профиль</div>
            </a>
            
            <a href="{{ route('profile.favorites') }}" class="action-button">
                <div class="action-icon">
                    <i class="fas fa-heart"></i>
                </div>
                <div class="action-text">Избранное</div>
            </a>
            
            <a href="{{ route('profile.booking') }}" class="action-button">
                <div class="action-icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <div class="action-text">Мои бронирования</div>
            </a>
            
            <a href="{{ route('profile.settings') }}" class="action-button">
                <div class="action-icon">
                    <i class="fas fa-cog"></i>
                </div>
                <div class="action-text">Настройки</div>
            </a>
        </div>
    </div>
    
    @include('partials.footer')
</body>
</html>