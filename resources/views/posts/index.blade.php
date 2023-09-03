@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-10">
                            {{ __('Посты') }}
                        </div>
                        <div class="col-2">
                            <a href="{{route('posts.create')}}" class="btn btn-primary">Создать</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">{{__('ID')}}</th>
                                <th scope="col">{{__('Наименование поста')}}</th>
                                <th scope="col">{{__('Имя автора')}}</th>
                                <th scope="col">{{__('Описание')}}</th>
                                <th scope="col">{{__('Действие')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $post )
                                <tr>
                                    <th scope="row">{{$post->id}}</th>
                                    <td>{{$post->title}}</td>
                                    <td>{{$post->user?->name}}</td>
                                    <td>{{$post->short_body}}</td>
                                    <td class="co">
                                        @if(Auth::id()===$post->user_id)
                                            <div class="d-grid gap-2 d-md-block">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <a href="{{route('posts.edit', $post->id)}}"
                                                           class="btn btn-primary">Редактировать</a>
                                                    </div>
                                                    <div class="col-6">
                                                        <form action="{{route('posts.destroy', $post->id)}}"
                                                              method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Удалить
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$posts->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
