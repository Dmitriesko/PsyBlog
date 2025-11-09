@extends('layouts.admin')

@section('title','Создать статью')

@section('content')
    <form method="post" action="{{route('admin.articles.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-container">
            <label for="title">Заголовок</label>
            <input id="title" type="text" name="title">
        </div>
        <div class="form-container">
            <label for="description">Описание</label>
            <input id="description" type="text" name="description">
        </div>
        <div class="form-container">
            <label for="content">Содержание</label>
            <textarea id="content" name="content"></textarea>
        </div>
        <div class="form-container">
            <label for="image_preview">Картинка превью</label>
            <input id="image_preview" type="file" name="image_preview" accept="image/*">
        </div>
        <div class="form-container">
            <label for="category_id">Категория</label>
            <select name="category_id" id="category_id" required>
                <option value="">Выберите категорию</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-container form-container__checkbox">
            <label for="is_published">Опубликована ли</label>
            <input id="is_published" type="checkbox" name="is_published">
        </div>
        <div class="form-control-container">
            <a class="btn-cansel" href="{{route('admin.articles.index')}}">Назад</a>
            <input class="btn-submit" type="submit" value="Сохранить">
        </div>
    </form>
@endsection

