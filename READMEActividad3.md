# Tarea 3 - Mini blog: Cada sección con su página

Para la creación de este readme si realicé uso de la IA para generarlo, de todas formas verifiqué la información anexada :c, gracias profe.

Proyecto desarrollado en **Laravel 13.39.0** con **PHP 8.3.36**, base de datos **SQLite** y entorno local **Laragon**. Se refactorizó el mini blog para separar cada sección en sus propias vistas HTML con formularios funcionales, validación del lado del servidor, mensajes flash de confirmación y estilos unificados mediante **Bootstrap 5**.

---

## Estructura General y Diseño Unificado

Todas las vistas heredan de la plantilla base `resources/views/layouts/app.blade.php`, la cual integra Bootstrap 5 vía CDN, un menú de navegación activo para las 4 secciones principales y alertas automáticas para mensajes de éxito (`session('success')`).

* **Posts (`/posts`)**: Listado en tarjetas y formulario de publicación con validación (`title` mínimo 5 caracteres, `body` mínimo 10 caracteres).
* **Categorías (`/categorias`)**: Listado en tarjetas y formulario de registro (`nombre` y `descripcion` requeridos).
* **Etiquetas (`/etiquetas`)**: Listado con insignias de color dinámico y formulario con selector de color (`nombre` mínimo 2 caracteres y `color` hexadecimal).
* **Contacto (`/contacto`)**: Nueva sección con su propia migración (`contactos`), modelo, controlador, listado de mensajes recibidos y formulario de envío con validación (`nombre` mínimo 3 caracteres, `email` válido y `mensaje` mínimo 10 caracteres).

---

## 1. Sección Posts

### Salida de `route:list` correspondiente

```text
  GET|HEAD  posts ............................................................................. posts.index › PostsController@index
  POST      posts ............................................................................. posts.store › PostsController@store
  GET|HEAD  posts/create .................................................................... posts.create › PostsController@create
```

### Código del formulario (`resources/views/posts/create.blade.php`)

```html
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
```

### Evidencia y recorrido

* **Conteo verificado en Tinker (`App\Models\Posts::count()`):** `6` registros en la base de datos.
* **Recorrido:** El usuario accede a `posts.create` y llena el título y el cuerpo del artículo, enviando el formulario vía **POST** protegido con `@csrf` hacia la ruta nombrada `posts.store`. El método `store()` de `PostsController` valida que no existan campos vacíos y que el título tenga al menos 5 caracteres (`min:5`) y el contenido 10 (`min:10`). Al guardarse en SQLite, redirige (`redirect()->route('posts.index')`) mostrando una alerta de confirmación mediante mensaje flash de sesión.

---

## 2. Sección Categorías

### Salida de `route:list` correspondiente

```text
  GET|HEAD  categorias ............................................................... categorias.index › CategoriaController@index
  POST      categorias ............................................................... categorias.store › CategoriaController@store
  GET|HEAD  categorias/create ...................................................... categorias.create › CategoriaController@create
  GET|HEAD  categorias/{id} ............................................................ categorias.show › CategoriaController@show
```

### Código del formulario (`resources/views/categorias/create.blade.php`)

```html
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
```

### Evidencia y recorrido

* **Conteo verificado en Tinker (`App\Models\Categoria::count()`):** `5` registros en la base de datos.
* **Recorrido:** Desde la vista estilizada de `categorias.index`, el usuario ingresa al formulario `categorias.create` y envía `nombre` y `descripcion` por petición **POST** con token `@csrf` hacia `categorias.store`. `CategoriaController@store` valida que ambos campos cumplan las reglas requeridas antes de insertar el registro mediante el modelo `Categoria`. Finalmente ejecuta una redirección hacia `categorias.index` con un mensaje flash de éxito, evitando reenvíos duplicados al recargar.

---

## 3. Sección Etiquetas

### Salida de `route:list` correspondiente

```text
  GET|HEAD  etiquetas .................................................................. etiquetas.index › EtiquetaController@index
  POST      etiquetas .................................................................. etiquetas.store › EtiquetaController@store
  GET|HEAD  etiquetas/create ......................................................... etiquetas.create › EtiquetaController@create
```

### Código del formulario (`resources/views/etiquetas/create.blade.php`)

```html
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
```

### Evidencia y recorrido

* **Conteo verificado en Tinker (`App\Models\Etiqueta::count()`):** `5` registros en la base de datos.
* **Recorrido:** Se reemplazó la antigua respuesta JSON de `/etiquetas` por una página Blade completa (`etiquetas.index`) enlazada al formulario `etiquetas.create`. Al enviar el nombre y color por **POST** con `@csrf` hacia `etiquetas.store`, `EtiquetaController@store` valida la longitud mínima y formato de los datos e inserta el registro en SQLite. Tras guardar, redirige a `etiquetas.index` mostrando la nueva etiqueta con su insignia de color y la alerta de confirmación.

---

## 4. Sección Contacto

### Salida de `route:list` correspondiente

```text
  GET|HEAD  contacto .................................................................... contacto.index › ContactoController@index
  POST      contacto .................................................................... contacto.store › ContactoController@store
  GET|HEAD  contacto/create ........................................................... contacto.create › ContactoController@create
```

### Código del formulario (`resources/views/contacto/create.blade.php`)

```html
@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h3 class="mb-0">Enviar Mensaje de Contacto</h3>
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
```

### Evidencia y recorrido

* **Conteo verificado en Tinker (`App\Models\Contacto::count()`):** `1` registro en la base de datos.
* **Recorrido:** Se creó desde cero la migración `create_contactos_table` y el modelo `Contacto` con los campos `nombre`, `email` y `mensaje`. El usuario llena el formulario en `contacto.create` y lo envía por **POST** protegido con `@csrf` hacia `contacto.store`, donde `ContactoController@store` valida que el correo tenga formato válido (`email`) y que nombre y mensaje cumplan las longitudes mínimas. Al almacenarse, redirige a `contacto.index` desplegando el mensaje enviado y su alerta de éxito.

---

## 5. Salida completa de `php artisan route:list` y conteo global en Tinker

```text
  GET|HEAD  / ................................................................................................... routes/web.php:10
  GET|HEAD  categorias ............................................................... categorias.index › CategoriaController@index
  POST      categorias ............................................................... categorias.store › CategoriaController@store
  GET|HEAD  categorias/create ...................................................... categorias.create › CategoriaController@create
  GET|HEAD  categorias/{id} ............................................................ categorias.show › CategoriaController@show
  GET|HEAD  contacto .................................................................... contacto.index › ContactoController@index
  POST      contacto .................................................................... contacto.store › ContactoController@store
  GET|HEAD  contacto/create ........................................................... contacto.create › ContactoController@create
  GET|HEAD  etiquetas .................................................................. etiquetas.index › EtiquetaController@index
  POST      etiquetas .................................................................. etiquetas.store › EtiquetaController@store
  GET|HEAD  etiquetas/create ......................................................... etiquetas.create › EtiquetaController@create
  GET|HEAD  hola ...................................................................................... HolaController@saludoSimple
  GET|HEAD  hola/{nombre} .......................................................................... HolaController@saludoConNombre
  GET|HEAD  posts ............................................................................. posts.index › PostsController@index
  POST      posts ............................................................................. posts.store › PostsController@store
  GET|HEAD  posts/create .................................................................... posts.create › PostsController@create
  GET|HEAD  storage/{path} ... storage.local › vendor/laravel/framework/src/Illuminate/Filesystem/FilesystemServiceProvider.php:111
  PUT       storage/{path} storage.local.upload › vendor/laravel/framework/src/Illuminate/Filesystem/FilesystemServiceProvider.php…
  GET|HEAD  up ................................................................................ Illuminate\Foundation › HealthCheck

                                                                                                                Showing [19] routes
```

**Conteo global verificado:**

```text
Posts: 6 | Categorias: 5 | Etiquetas: 5 | Contactos: 1
```

---

## 6. Instalación y Ejecución Local

1. Clonar el repositorio o descomprimir el proyecto.
2. Instalar dependencias de Composer:
   ```bash
   composer install
   ```
3. Configurar el archivo de entorno y la clave de aplicación:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. Ejecutar las migraciones en SQLite:
   ```bash
   php artisan migrate
   ```
5. Iniciar el servidor de desarrollo:
   ```bash
   php artisan serve
   ```