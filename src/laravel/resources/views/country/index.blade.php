@extends('admin.layout')

@section('title', 'Управление странами')

@section('content')
    <div class="d-flex justify-between align-center mb-20">
        <h2>Страны</h2>
        <a href="{{ route('countries.create') }}" class="btn btn-primary">
            ➕ Добавить страну
        </a>
    </div>

    <div class="d-flex gap-10 mb-20">
        <a href="{{ route('admin.tables') }}" class="btn btn-secondary">Назад к таблицам</a>
    </div>

    @if(count($countries) > 0)
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Название страны</th>
                        <th>Дата создания</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($countries as $country)
                        <tr>
                            <td><strong>#{{ $country->ID_country }}</strong></td>
                            <td>{{ $country->country }}</td>
                            <td>{{ $country->created_at->format('d.m.Y H:i') }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('countries.show', $country) }}" class="btn btn-primary btn-sm">
                                        👁 Просмотр
                                    </a>
                                    <a href="{{ route('countries.edit', $country) }}" class="btn btn-warning btn-sm">
                                        ✏ Изменить
                                    </a>
                                    <form action="{{ route('countries.destroy', $country) }}" method="POST">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" 
                                                onclick="return confirm('Удалить страну?')">
                                            🗑 Удалить
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Пагинация (если нужно) -->
        @if($countries instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="pagination">
                {{ $countries->links() }}
            </div>
        @endif
    @else
        <div class="card text-center">
            <p>📭 Нет добавленных стран</p>
            <a href="{{ route('countries.create') }}" class="btn btn-success mt-20">Добавить первую страну</a>
        </div>
    @endif
@endsection