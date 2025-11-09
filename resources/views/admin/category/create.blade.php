@extends('layouts.admin')

@section('content')
    <h1>Создать категорию</h1>

    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        <div class="form-container">
            <label for="title">Название</label>
            <input id="title" type="text" name="title" placeholder="Название" required>
        </div>
        <div class="form-control-container">
            <a class="btn-cansel" href="{{route('admin.articles.index')}}">Назад</a>
            <input class="btn-submit" type="submit" value="Сохранить">
        </div>
    </form>
@endsection
