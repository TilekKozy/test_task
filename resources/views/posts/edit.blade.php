@props([
    'post',
])

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-10">
                            {{ __('Редактирование поста') }}
                        </div>
                        <div class="col-2">
                            <button href="{{route('posts.update',$post->id)}}" type="button" class="btn btn-primary">Создать</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('posts.update',$post->id)}}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Наименование поста</label>
                            <input type="text" name="title" class="form-control" id="exampleFormControlInput1" value="{{$post->title}}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Описание</label>
                            <textarea name="body" class="form-control" id="exampleFormControlTextarea1" rows="3">
                                {{$post->body}}
                            </textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Обновить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
