<!DOCTYPE html>
<html>
<head>
    <title>Админка - TRALALELO TRALALA</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}?v=1">
</head>
<body>
    <div class="admin-header">
        <h1>Админ-панель TRALALELO TRALALA</h1>
        <div class="admin-nav">
            <a href="{{ route('admin.dashboard') }}">Главная</a>
            <a href="{{ route('admin.tables') }}">Все таблицы</a>
            <a href="{{ route('admin.queries') }}">Запросы</a>
            <a href="{{ route('main') }}">На сайт</a>
        </div>
    </div>

    <!-- Первый ряд статистики -->
    <div class="admin-stats">
        <div class="admin-stat">
            <h3>Клиенты</h3>
            <p>{{ $stats['clients'] }}</p>
        </div>
        <div class="admin-stat">
            <h3>Туры</h3>
            <p>{{ $stats['tours'] }}</p>
        </div>
        <div class="admin-stat">
            <h3>Бронирования</h3>
            <p>{{ $stats['bookings'] }}</p>
        </div>
        <div class="admin-stat">
            <h3>Страны</h3>
            <p>{{ $stats['countries'] }}</p>
        </div>
        <div class="admin-stat">
            <h3>Персональные данные</h3>
            <p>{{ $stats['personnel'] }}</p>
        </div>
    </div>

    <!-- Второй ряд статистики -->
    <div class="admin-stats">
        <div class="admin-stat">
            <h3>Роли </h3>
            <p>0</p>
        </div>
        <div class="admin-stat">
            <h3>Типы туров </h3>
            <p>0</p>
        </div>
        <div class="admin-stat">
            <h3>Участники бронирования </h3>
            <p>0</p>
        </div>
        <div class="admin-stat">
            <h3>Города</h3>
            <p>0</p>
        </div>
        <div class="admin-stat">
            <h3>Категории отлея</h3>
            <p>0</p>
        </div>
    </div>

    <div class="admin-menu">
        <h3>Быстрый доступ</h3>
        <div class="admin-menu-links">
            <a href="{{ route('admin.tables') }}?table=clients">Управление клиентами</a>
            <a href="{{ route('admin.tables') }}?table=tours">Управление турами</a>
            <a href="{{ route('admin.tables') }}?table=bookings">Управление бронированиями</a>
            <a href="{{ route('admin.tables') }}?table=countries">Управление странами</a>
            <a href="{{ route('admin.queries') }}">Выполнить запросы</a>
        </div>
    </div>
</body>
</html>