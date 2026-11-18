@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-0">Publicaciones del Blog</h2>
            <p class="text-muted mb-0">Artículos recientes sobre diseño y desarrollo.</p>
        </div>
        <a href="{{ route('posts.create') }}" class="btn btn-primary">+ Nuevo Post</a>
    </div>
    <div class="row g-3">
        @foreach ($posts as $post)
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title">{{ $post->title }}</h4>
                        <p class="card-text text-secondary">{{ $post->body }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection