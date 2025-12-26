<!DOCTYPE html>
<html>
<head>
    <title>Админка - TRALALELO TRALALA</title>
    <meta charset="UTF-8">
   
</head>
<body>
    <div class="header">
        <h1>Админ-панель TRALALELO TRALALA</h1>
        <div class="nav">
            <a href="{{ route('admin.dashboard') }}">Главная</a>
            <a href="{{ route('admin.tables') }}">Все таблицы</a>
            <a href="{{ route('admin.queries') }}">Запросы</a>
            <a href="{{ route('main') }}">На сайт</a>
        </div>
    </div>

    <div class="stats">
        <div class="stat">
            <h3> Клиенты</h3>
            <p style="font-size: 24px; font-weight: bold;">{{ $stats['clients'] }}</p>
        </div>
        <div class="stat">
            <h3>Туры</h3>
            <p style="font-size: 24px; font-weight: bold;">{{ $stats['tours'] }}</p>
        </div>
        <div class="stat">
            <h3>Бронирования</h3>
            <p style="font-size: 24px; font-weight: bold;">{{ $stats['bookings'] }}</p>
        </div>
        <div class="stat">
            <h3>Страны</h3>
            <p style="font-size: 24px; font-weight: bold;">{{ $stats['countries'] }}</p>
        </div>
        <div class="stat">
            <h3> Персональные данные</h3>
            <p style="font-size: 24px; font-weight: bold;">{{ $stats['personnel'] }}</p>
        </div>
    </div>

    <div class="menu">
        <h3>Быстрый доступ</h3>
        <a href="{{ route('admin.tables') }}?table=clients"> Управление клиентами</a>
        <a href="{{ route('admin.tables') }}?table=tours"> Управление турами</a>
        <a href="{{ route('admin.tables') }}?table=bookings"> Управление бронированиями</a>
        <a href="{{ route('admin.tables') }}?table=countries"> Управление странами</a>
        <a href="{{ route('admin.queries') }}"> Выполнить запросы</a>
    </div>
</body>
</html>