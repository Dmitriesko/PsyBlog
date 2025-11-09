@extends('layouts.admin')

@section('content')
    <h1>Редактировать категорию</h1>

    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-container">
            <label for="title">Название</label>
            <input id="title" type="text" name="title" placeholder="Название" required>
        </div>
        <div class="form-control-container">
            <a class="btn-cansel" href="{{route('admin.categories.index')}}">Назад</a>
            <input class="btn-submit" type="submit" value="Сохранить">
        </div>
    </form>
@endsection


{{--@section('content')--}}
{{--    <h1>Редактировать категорию</h1>--}}

{{--    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">--}}
{{--        @csrf--}}
{{--        <div class="form-container">--}}
{{--            <label for="title">Название</label>--}}
{{--            <input type="text" name="name" placeholder="Название" required>--}}
{{--        </div>--}}
{{--        <div class="form-control-container">--}}
{{--            <a class="btn-cansel" href="{{route('admin.categories.index')}}">Назад</a>--}}
{{--            <input class="btn-submit" type="submit" value="Сохранить">--}}
{{--        </div>--}}
{{--    </form>--}}
{{--@endsection--}}
