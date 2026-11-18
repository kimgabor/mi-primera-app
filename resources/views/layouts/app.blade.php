<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi blog Design</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('posts.index') }}">Mi blog Design</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('posts.*') ? 'active fw-bold' : '' }}" href="{{ route('posts.index') }}">Posts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('categorias.*') ? 'active fw-bold' : '' }}" href="{{ route('categorias.index') }}">Categorías</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('etiquetas.*') ? 'active fw-bold' : '' }}" href="{{ route('etiquetas.index') }}">Etiquetas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contacto.*') ? 'active fw-bold' : '' }}" href="{{ route('contacto.index') }}">Contacto</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container flex-grow-1 mb-5">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>
    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <div class="container">
            <p class="mb-0">&copy; 2026 Mi blog Design. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>