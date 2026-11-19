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
        @forelse ($posts as $post)
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title">{{ $post->title }}</h4>
                        <p class="card-text text-secondary">{{ $post->body }}</p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <small class="text-muted">Publicado {{ $post->created_at->format('d/m/Y') }}</small>
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info mb-0">Todavía no hay posts. Crea el primero.</div>
            </div>
        @endforelse
    </div>
@endsection