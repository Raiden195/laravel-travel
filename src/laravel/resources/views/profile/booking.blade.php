<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мои бронирования | TRALALELO TRALALA</title>
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
        
        .tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }
        
        .tab {
            padding: 10px 20px;
            background: none;
            border: none;
            cursor: pointer;
            font-weight: 500;
            color: #666;
            border-radius: 8px 8px 0 0;
            transition: all 0.3s ease;
        }
        
        .tab.active {
            color: #007bff;
            border-bottom: 3px solid #007bff;
        }
        
        .booking-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.05);
            border-left: 5px solid #007bff;
        }
        
        .booking-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
        }
        
        .booking-title {
            font-size: 20px;
            font-weight: 600;
            color: #333;
            margin-bottom: 5px;
        }
        
        .booking-status {
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
        }
        
        .status-active {
            background: #d4edda;
            color: #155724;
        }
        
        .status-completed {
            background: #e2e3e5;
            color: #383d41;
        }
        
        .status-cancelled {
            background: #f8d7da;
            color: #721c24;
        }
        
        .booking-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
        }
        
        .detail-item h4 {
            font-size: 14px;
            color: #666;
            margin-bottom: 5px;
        }
        
        .detail-item p {
            font-size: 16px;
            font-weight: 500;
            color: #333;
        }
        
        .booking-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }
        
        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            border: none;
        }
        
        .btn-primary {
            background: #007bff;
            color: white;
        }
        
        .btn-primary:hover {
            background: #0056b3;
        }
        
        .btn-outline {
            background: white;
            color: #007bff;
            border: 2px solid #007bff;
        }
        
        .btn-outline:hover {
            background: #007bff;
            color: white;
        }
        
        .btn-danger {
            background: #dc3545;
            color: white;
        }
        
        .btn-danger:hover {
            background: #bd2130;
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
            <h1 class="profile-title">Мои бронирования</h1>
            <a href="{{ route('profile.index') }}" class="btn-outline">
                <i class="fas fa-arrow-left"></i> Назад
            </a>
        </div>
        
        <div class="tabs">
            <button class="tab active" data-tab="all">Все бронирования</button>
            <button class="tab" data-tab="active">Активные</button>
            <button class="tab" data-tab="completed">Завершенные</button>
            <button class="tab" data-tab="cancelled">Отмененные</button>
        </div>
        
        <!-- Пример бронирования -->
        <div class="booking-card" data-status="active">
            <div class="booking-header">
                <div>
                    <h3 class="booking-title">Турция, Анталия - Отель Luxury Resort</h3>
                    <p>Номер брони: #BK-2023-001</p>
                </div>
                <span class="booking-status status-active">Активно</span>
            </div>
            
            <div class="booking-details">
                <div class="detail-item">
                    <h4>Даты</h4>
                    <p>15.06.2023 - 22.06.2023</p>
                </div>
                <div class="detail-item">
                    <h4>Количество ночей</h4>
                    <p>7 ночей</p>
                </div>
                <div class="detail-item">
                    <h4>Туристы</h4>
                    <p>2 взрослых</p>
                </div>
                <div class="detail-item">
                    <h4>Стоимость</h4>
                    <p>45 000 ₽</p>
                </div>
            </div>
            
            <div class="booking-actions">
                <a href="#" class="btn btn-primary">
                    <i class="fas fa-file-invoice"></i> Детали
                </a>
                <button class="btn btn-outline">
                    <i class="fas fa-print"></i> Печать
                </button>
                <button class="btn btn-danger">
                    <i class="fas fa-times"></i> Отменить
                </button>
            </div>
        </div>
        
        <!-- Если бронирований нет -->
        <div class="empty-state">
            <i class="fas fa-calendar-alt"></i>
            <h3>Бронирований нет</h3>
            <p>У вас пока нет забронированных туров</p>
            <a href="{{ route('tour') }}" class="btn-primary" style="margin-top: 20px;">
                <i class="fas fa-search"></i> Найти туры
            </a>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.tab');
            const bookingCards = document.querySelectorAll('.booking-card');
            
            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    // Убираем активный класс у всех вкладок
                    tabs.forEach(t => t.classList.remove('active'));
                    // Добавляем активный класс текущей вкладке
                    this.classList.add('active');
                    
                    const tabId = this.dataset.tab;
                    
                    // Фильтруем бронирования
                    bookingCards.forEach(card => {
                        if (tabId === 'all' || card.dataset.status === tabId) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            });
        });
    </script>
    
    @include('partials.footer')
</body>
</html>