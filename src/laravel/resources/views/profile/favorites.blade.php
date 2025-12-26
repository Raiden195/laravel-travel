<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Избранное | TRALALELO TRALALA</title>
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
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }
        
        .btn-outline:hover {
            background: #007bff;
            color: white;
        }
        
        .favorites-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
            margin-top: 30px;
        }
        
        .favorite-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }
        
        .favorite-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
        
        .card-image {
            height: 180px;
            background: #f5f5f5;
            position: relative;
        }
        
        .card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .favorite-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            background: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #ff4757;
            font-size: 18px;
        }
        
        .card-content {
            padding: 20px;
        }
        
        .card-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 10px;
            color: #333;
        }
        
        .card-details {
            display: flex;
            gap: 15px;
            font-size: 14px;
            color: #666;
            margin-bottom: 15px;
        }
        
        .card-price {
            font-size: 22px;
            font-weight: 700;
            color: #007bff;
            margin-bottom: 15px;
        }
        
        .card-actions {
            display: flex;
            gap: 10px;
        }
        
        .btn-book {
            flex: 1;
            background: #007bff;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        
        .btn-book:hover {
            background: #0056b3;
        }
        
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #666;
        }
        
        .empty-state i {
            font-size: 80px;
            color: #ddd;
            margin-bottom: 20px;
        }
        
        .empty-state h3 {
            font-size: 24px;
            margin-bottom: 10px;
            color: #333;
        }
    </style>
</head>
<body>
    @include('partials.header')
    
    <div class="profile-container">
        <div class="profile-header">
            <h1 class="profile-title">Избранное</h1>
            <a href="{{ route('profile.index') }}" class="btn-outline">
                <i class="fas fa-arrow-left"></i> Назад
            </a>
        </div>
        
        <div class="favorites-grid">
            <!-- Пример карточки тура -->
            <div class="favorite-card">
                <div class="card-image">
                    <img src="{{ asset('images/default-tour.jpg') }}" alt="Тур в Турцию">
                    <button class="favorite-btn">
                        <i class="fas fa-heart"></i>
                    </button>
                </div>
                <div class="card-content">
                    <h3 class="card-title">Турция, Анталия</h3>
                    <div class="card-details">
                        <span><i class="far fa-calendar"></i> 7 ночей</span>
                        <span><i class="fas fa-users"></i> 2 чел.</span>
                    </div>
                    <div class="card-price">45 000 ₽</div>
                    <div class="card-actions">
                        <button class="btn-book">Забронировать</button>
                        <button class="btn-outline" style="padding: 10px;">
                            <i class="fas fa-info-circle"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Еще карточки... -->
        </div>
        
        <!-- Если избранное пусто -->
        <div class="empty-state" style="display: none;">
            <i class="fas fa-heart"></i>
            <h3>Избранное пусто</h3>
            <p>Добавляйте понравившиеся туры в избранное</p>
            <a href="{{ route('tour') }}" class="btn-outline" style="margin-top: 20px;">
                <i class="fas fa-search"></i> Найти туры
            </a>
        </div>
    </div>
    
    @include('partials.footer')
</body>
</html>