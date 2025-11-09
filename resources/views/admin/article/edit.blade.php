@extends('layouts.admin')

@section('title','Редактировать статью')

@section('content')
    <form action="{{ route('admin.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-container">
            <label for="title">Заголовок</label>
            <input id="title" type="text" name="title" value="{{ old('title', $article->title) }}">
        </div>

        <div class="form-container">
            <label for="description">Описание</label>
            <input id="description" type="text" name="description" value="{{ old('description', $article->description) }}">
        </div>

        <div class="form-container">
            <label for="content">Содержание</label>
            <textarea id="content" name="content">{{ old('content', $article->content) }}</textarea>
        </div>

        <div class="form-container">
            @if($article->image_preview)
                <img src="{{ asset('storage/' . $article->image_preview) }}" alt="" style="max-width:200px">
            @endif
            <input type="file" name="image_preview" accept="image/*">
        </div>
        <div class="form-container">
            <label for="category_id">Категория</label>
            <select name="category_id" id="category_id" required>
                <option value="">Выберите категорию</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ isset($article) && $article->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->title }}
                    </option>
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

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection


