<!DOCTYPE html>
<html>
<head>
    <title>Таблицы - Админка</title>
    <meta charset="UTF-8">
</head>
<body>
    <div class="header">
        <h1>Управление таблицами</h1>
        <div class="nav">
            <a href="{{ route('admin.dashboard') }}">Главная</a>
            <a href="{{ route('admin.tables') }}">Все таблицы</a>
            <a href="{{ route('admin.queries') }}">Запросы</a>
            <a href="{{ route('main') }}">На сайт</a>
        </div>
    </div>

    <h2>Выбор таблицы</h2>
<h2>Выбор таблицы</h2>
<select class="table-select" onchange="window.location.href = this.value;">
    <option value="">-- Выберите таблицу --</option>
    @foreach($tables as $key => $name)
        @if($table == $key)
            <option value="{{ $key }}" selected>{{ $name }}</option>
        @else
            <option value="{{ $key }}">{{ $name }}</option>
        @endif
    @endforeach
</select>
<select class="table-select" onchange="if(this.value) window.location.href = this.value;">

    @if($table && isset($tables[$table]))
        <h3>Данные таблицы: {{ $tables[$table] }} ({{ count($data) }} записей)</h3>
        
        @if(count($data) > 0)
            <table>
                <thead>
                    <tr>
                        @foreach($columns as $column)
                            <th>{{ $column }}</th>
                        @endforeach
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $item)
                    <tr>
                        @foreach($columns as $column)
                            <td>
                                @if(is_object($item->$column) && method_exists($item->$column, '__toString'))
                                    {{ $item->$column->__toString() }}
                                @else
                                    {{ $item->$column }}
                                @endif
                            </td>
                        @endforeach
                        <td>
                            @php
                                $id = $item->id ?? $item->ID_client ?? $item->ID_tour ?? $item->ID_country ?? $item->getKey();
                            @endphp
                            <form action="{{ route('admin.quick-delete', [$table, $id]) }}" method="POST" style="display:inline;">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Удалить запись?')">Удалить</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Нет данных в таблице</p>
        @endif

        <div class="add-form">
            <h3>Добавить новую запись</h3>
            <form action="{{ route('admin.quick-add') }}" method="POST">
                @csrf
                <input type="hidden" name="table" value="{{ $table }}">
                
                @if(count($data) > 0)
                    @foreach($columns as $column)
                        @if(!in_array($column, ['id', 'ID_client', 'ID_tour', 'ID_country', 'created_at', 'updated_at']))
                            <div style="margin: 10px 0;">
                                <label style="display: inline-block; width: 150px;">{{ $column }}:</label>
                                <input type="text" name="{{ $column }}" placeholder="Введите {{ $column }}">
                            </div>
                        @endif
                    @endforeach
                @else
                    <p>Введите данные для новой записи:</p>
                    <input type="text" name="name" placeholder="Название">
                @endif
                
                <button type="submit" class="btn btn-primary">Добавить запись</button>
            </form>
        </div>
    @else
        <p>Выберите таблицу для просмотра и редактирования</p>
    @endif
</body>
</html>