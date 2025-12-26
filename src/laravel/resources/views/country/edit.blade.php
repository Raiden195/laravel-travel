@extends('layouts.app')

@section('content')
    <h1>Изменить страну</h1>
    
    <form action="{{ route('countries.update', $country) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Название страны:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $country->name }}" required>
        </div>
        
        <button type="submit" class="btn btn-success">Обновить</button>
        <a href="{{ route('countries.index') }}" class="btn btn-secondary">Отмена</a>
    </form>
@endsection