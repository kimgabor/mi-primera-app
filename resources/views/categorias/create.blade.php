@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h3 class="mb-0">Crear una nueva Categoría</h3>
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
                    <form method="POST" action="{{ route('categorias.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="nombre" class="form-label fw-bold">Nombre:</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label fw-bold">Descripción:</label>
                            <textarea id="descripcion" name="descripcion" rows="3" class="form-control" required>{{ old('descripcion') }}</textarea>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Guardar Categoría</button>
                            <a href="{{ route('categorias.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection