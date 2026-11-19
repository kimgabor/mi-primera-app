@extends('layouts.app')

@section('title', 'Editar post | Mini blog')

@section('content')
    <h1 class="mb-3">Editar post</h1>
    <form method="POST" action="/posts/{{ $post->id }}">
        @csrf
        @method('PUT')
       <div>
        <label for="title">Título:</label>
        <input type="text" name="title" id="title" value="{{ $post->title }}">
        </div>
        <div>
        <label for="body">Texto:</label>
        <textarea name="body" id="body">{{ $post->body }}</textarea>
        </div>
        <button type="submit">Actualizar</button>
    </form>
@endsection