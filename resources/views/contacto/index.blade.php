@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-0">Mensajes de Contacto</h2>
            <p class="text-muted mb-0">Consultas y mensajes recibidos de los lectores.</p>
        </div>
        <a href="{{ route('contacto.create') }}" class="btn btn-primary">+ Nuevo Mensaje</a>
    </div>
    <div class="row g-3">
        @foreach ($mensajes as $item)
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="card-title mb-0">{{ $item->nombre }}</h5>
                            <span class="badge bg-secondary">{{ $item->email }}</span>
                        </div>
                        <p class="card-text text-secondary mb-0">{{ $item->mensaje }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection