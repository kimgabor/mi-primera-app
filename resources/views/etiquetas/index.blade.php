@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-0">Etiquetas del Blog</h2>
            <p class="text-muted mb-0">Temas y palabras clave para clasificar el contenido.</p>
        </div>
        <a href="{{ route('etiquetas.create') }}" class="btn btn-primary">+ Nueva Etiqueta</a>
    </div>
    <div class="row g-3">
        @foreach ($etiquetas as $etiqueta)
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <span class="fw-bold fs-5">{{ $etiqueta->nombre }}</span>
                        <span class="badge rounded-pill" style="background-color: {{ $etiqueta->color }};">
                            {{ $etiqueta->color }}
                        </span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection