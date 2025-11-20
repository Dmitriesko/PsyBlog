@extends('layouts.admin')

@section('title','Список статей')

@section('content')

    <div class="article-list__filters mb-3 d-flex justify-content-between">
        <form action="" method="get" class="d-flex align-items-center gap-5" {{--style="gap:20px"--}}>
            <div class="article-list__filter-item">
                <input type="text" name="search" class="form-control" placeholder="Поиск..." value="{{ request('search') }}">
            </div>

            <div class="article-list__filter-item">
                <select name="category" class="form-select">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="article-list__filter-item form-check">
                <label class="form-check-label" for="articleListFilterPublished">Опубликована</label>
                <input type="checkbox" class="form-check-input" name="is_published" id="articleListFilterPublished" {{ request()->has('is_published') ? 'checked' : '' }}>
            </div>

            <button type="submit" class="btn btn-info">Применить</button>
        </form>
        <a class="btn btn-primary" href="{{ route('admin.articles.create') }}"><i class="fa-solid fa-plus "></i> Создать статью </a>
    </div>



    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Заголовок</th>
            <th>Описание</th>
            <th>Опубликована</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach($articles as $article)
            <tr>
                <td>{{$article->id}}</td>
                <td>{{$article->title}}</td>
                <td>{{$article->description}}
                </td>
                <td>{{$article->is_published===true ? 'Да' : 'Нет'}}</td>
                <td>
                    <div class="table-row__control">
                        <a href="{{ route('admin.articles.show', $article->id) }}" class="btn btn-sm btn-primary">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.articles.edit', $article->id) }}" class="btn btn-sm btn-warning">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST"
                              class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Удалить статью?')">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </div>

                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    {{ $articles->links() }}
@endsection

