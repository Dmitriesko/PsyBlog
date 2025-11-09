@extends('layouts.admin')

@section('title','Список статей')

@section('content')
    <a href="{{ route('admin.articles.create') }}"><i class="fa-solid fa-plus"></i> Создать статью </a>

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
                <td >
                    <div class="table-row__control">
                        <a href="{{ route('admin.articles.show', $article->id) }}" class="btn btn-sm btn-primary">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.articles.edit', $article->id) }}" class="btn btn-sm btn-warning">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST" class="d-inline">
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
@endsection

