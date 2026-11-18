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