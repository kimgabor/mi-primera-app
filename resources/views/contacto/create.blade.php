@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
              <h3 class="mb-0">Enviar Mensaje de Contacto</h3>
                </div>                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('contacto.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="nombre" class="form-label fw-bold">Nombre completo:</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Correo electrónico:</label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="mensaje" class="form-label fw-bold">Mensaje:</label>
                            <textarea id="mensaje" name="mensaje" rows="4" class="form-control" required>{{ old('mensaje') }}</textarea>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Enviar Mensaje</button>
                            <a href="{{ route('contacto.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection