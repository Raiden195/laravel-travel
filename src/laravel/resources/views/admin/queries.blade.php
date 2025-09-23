<!DOCTYPE html>
<html>
<head>
    <title>Запросы - Админка</title>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial; margin: 20px; background: #f0f0f0; }
        .header { background: #333; color: white; padding: 15px; margin-bottom: 20px; }
        .nav a { color: white; margin-right: 15px; text-decoration: none; }
        .nav a:hover { text-decoration: underline; }
        .query-section { background: white; padding: 20px; margin-bottom: 20px; border-radius: 5px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background: #f5f5f5; }
        .query-title { background: #e9ecef; padding: 10px; border-radius: 3px; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Запросы к базе данных</h1>
        <div class="nav">
            <a href="{{ route('admin.dashboard') }}">Главная</a>
            <a href="{{ route('admin.tables') }}">Все таблицы</a>
            <a href="{{ route('admin.queries') }}">Запросы</a>
            <a href="{{ route('main') }}">На сайт</a>
        </div>
    </div>

    @foreach($queries as $title => $data)
        <div class="query-section">
            <div class="query-title">
                <h3>{{ $title }} ({{ $data->count() }} записей)</h3>
            </div>
            
            @if($data->count() > 0)
                <table>
                    <thead>
                        <tr>
                            @php
                                $firstItem = $data->first();
                                if ($firstItem) {
                                    $attributes = $firstItem->getAttributes();
                                    // Для связанных данных
                                    if (method_exists($firstItem, 'getRelations')) {
                                        $relations = $firstItem->getRelations();
                                        foreach ($relations as $relationName => $relation) {
                                            if ($relation) {
                                                if (is_iterable($relation)) {
                                                    $firstRelation = $relation->first();
                                                } else {
                                                    $firstRelation = $relation;
                                                }
                                                if ($firstRelation && method_exists($firstRelation, 'getAttributes')) {
                                                    $relationAttributes = $firstRelation->getAttributes();
                                                    foreach ($relationAttributes as $key => $value) {
                                                        $attributes[$relationName . '.' . $key] = $value;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            @endphp
                            
                            @if(isset($attributes))
                                @foreach(array_keys($attributes) as $column)
                                    <th>{{ $column }}</th>
                                @endforeach
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $item)
                            <tr>
                                @foreach($item->getAttributes() as $value)
                                    <td>
                                        @if(is_array($value) || is_object($value))
                                            {{ json_encode($value) }}
                                        @else
                                            {{ $value }}
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Нет данных для отображения</p>
            @endif
        </div>
    @endforeach
</body>
</html>