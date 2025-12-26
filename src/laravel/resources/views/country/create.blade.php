@extends('layouts.app')

@section('content')
    <h1>Добавить страну</h1>
    
    <form action="{{ route('countries.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Название страны:</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        
        <button type="submit" class="btn btn-success">Сохранить</button>
        <a href="{{ route('countries.index') }}" class="btn btn-secondary">Отмена</a>
    </form>
@endsection