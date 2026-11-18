@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h3 class="mb-0">Crear un nuevo Post</h3>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('posts.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label fw-bold">Título (mínimo 5 caracteres):</label>
                            <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="body" class="form-label fw-bold">Contenido (mínimo 10 caracteres):</label>
                            <textarea id="body" name="body" rows="5" class="form-control" required>{{ old('body') }}</textarea>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Publicar Post</button>
                            <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection