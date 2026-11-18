@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h3 class="mb-0">Crear una nueva Etiqueta</h3>
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
                    <form method="POST" action="{{ route('etiquetas.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="nombre" class="form-label fw-bold">Nombre de la etiqueta:</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="color" class="form-label fw-bold">Color identificador:</label>
                            <input type="color" id="color" name="color" class="form-control form-control-color" value="{{ old('color', '#0d6efd') }}" required>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Guardar Etiqueta</button>
                            <a href="{{ route('etiquetas.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection