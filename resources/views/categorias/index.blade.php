@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-0">Listado de Categorías</h2>
            <p class="text-muted mb-0">Explora todas las categorías disponibles en el blog.</p>
        </div>
        <a href="{{ route('categorias.create') }}" class="btn btn-primary">+ Nueva Categoría</a>
    </div>

    <div class="row g-3">
        @foreach ($categorias as $categoria)
            <div class="col-md-6">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h4 class="card-title">{{ $categoria->nombre }}</h4>
                        <p class="card-text text-secondary mb-0">{{ $categoria->descripcion }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection