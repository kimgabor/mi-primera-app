# Actividad por participación 3 - Mini blog: categorías, de JSON a página
Proyecto desarrollado en **Laravel 13.39.0**, **PHP 8.3.36** y **SQLite** (`mi-primera-app`). 
Nuevamente el readme me ayudo a realizarlo la IA, sin embargo todos los comandos y la creacion de las vistas y el flujo fueron verificados y creados por mi .
---
## 1. Salida de `php artisan route:list --path=categorias`
```text
  GET|HEAD   categorias ..................................................... categorias.index › CategoriaController@index
  POST       categorias ..................................................... categorias.store › CategoriaController@store
  GET|HEAD   categorias/create ............................................ categorias.create › CategoriaController@create
  GET|HEAD   categorias/{id} .................................................. categorias.show › CategoriaController@show

                                                                                                        Showing [4] routes
```
---
## 2. Código del formulario (`resources/views/categorias/create.blade.php`)
```blade
@extends('layouts.app')
@section('content')
    <h2>Crear una nueva Categoría</h2>
    @if ($errors->any())
        <div style="color: red; margin-bottom: 15px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('categorias.store') }}">
        @csrf
        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
        </div>
        <div>
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" required></textarea>
        </div>
        <button type="submit">Guardar Categoría</button>
    </form>
@endsection
```

---
## 3. Conteo de registros (`Categoria::count()`)

* **Antes de crear la nueva categoría:** `3`
* **Después de crear la nueva categoría:** `4`

---
## 4. Explicación del flujo (`form → POST → store → redirect`)

El usuario llena los campos del formulario HTML (`create.blade.php`) y los envía mediante una petición **POST** protegida con el token `@csrf` hacia la ruta `categorias.store`.  
Esta ruta dirige la petición al método **`store()`** de `CategoriaController`, el cual valida que `nombre` y `descripcion` cumplan con las reglas requeridas antes de insertarlos en la base de datos SQLite.  
Una vez guardado el registro, el controlador ejecuta un **`redirect()`** hacia `categorias.index` adjuntando un mensaje flash de sesión (`with('success', ...)`), lo que evita envíos duplicados al recargar y confirma visualmente la creación en la lista.