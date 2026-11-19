@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-0">Categorías</h2>
            <p class="text-muted mb-0">Clasificación temática del blog.</p>
        </div>
        <a href="{{ route('categorias.create') }}" class="btn btn-primary">+ Nueva Categoría</a>
    </div>

    <div class="row g-3">
        @forelse ($categorias as $categoria)
            <div class="col-md-6">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <h4 class="card-title">{{ $categoria->nombre }}</h4>
                            <p class="card-text text-secondary">{{ $categoria->descripcion }}</p>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-3 pt-2 border-top">
                            <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-sm btn-outline-primary">Editar</a>

                            <form method="POST" action="{{ route('categorias.destroy', $categoria->id) }}" onsubmit="return confirm('¿Seguro que deseas eliminar esta categoría?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Borrar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info mb-0">No hay categorías registradas todavía.</div>
            </div>
        @endforelse
    </div>
@endsection