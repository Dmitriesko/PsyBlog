@extends('layouts.admin')

@section('title','Категории')

@section('content')
    <a href="{{ route('admin.categories.create') }}"><i class="fa-solid fa-plus"></i> Создать категорию </a>

    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Категория</th>
            <th class="table-header__control">Действия</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            @foreach($categories as $category)
            <td>{{$category->id}}</td>
            <td>{{$category->title}}</td>
            <td class="table-row__control">
                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-warning">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger"
                            onclick="return confirm('Удалить статью?')">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
@endsection



