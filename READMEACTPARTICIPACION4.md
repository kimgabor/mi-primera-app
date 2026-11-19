# Actividad por Participación 4 — Mini blog: Categorías (CRUD completo)
---

## 1. Descripción de la actividad
Se completó el CRUD (Crear, Leer, Actualizar y Eliminar) del recurso **Categorías** en el proyecto `mi-primera-app`, incorporando:
- **Edición (`edit`):** Formulario precargado con el nombre y descripción actuales de cada categoría mediante `old(..., $categoria->...)`.
- **Actualización (`update`):** Validación en servidor (`nombre` con mínimo 3 caracteres y `descripcion` obligatoria con mínimo 5 caracteres), actualización en SQLite y redirección a `/categorias` con mensaje de confirmación.
- **Borrado (`destroy`):** Botón por categoría con petición `DELETE` protegida con `@csrf` y `@method('DELETE')` que elimina el registro y redirige al listado.

---

## 2. Evidencia de rutas (`php artisan route:list --path=categorias`, "Las mismas rutas son iguales a lo que me arrojo la consola")

```text
PS C:\laragon\www\mi-primera-app> php artisan route:list --path=categorias

  GET|HEAD  categorias ................................................................ categorias.index › CategoriaController@index
  POST      categorias ................................................................ categorias.store › CategoriaController@store
  GET|HEAD  categorias/create ....................................................... categorias.create › CategoriaController@create
  GET|HEAD  categorias/{id} ............................................................. categorias.show › CategoriaController@show
  PUT       categorias/{id} ......................................................... categorias.update › CategoriaController@update
  DELETE    categorias/{id} ....................................................... categorias.destroy › CategoriaController@destroy
  GET|HEAD  categorias/{id}/edit ........................................................ categorias.edit › CategoriaController@edit

                                                                                                                  Showing [7] routes
```

---

## 3. Evidencia de conteo en base de datos antes y después de borrar (`Categoria::count()`)

### Conteo antes de eliminar una categoría:
```text
PS C:\laragon\www\mi-primera-app> php artisan tinker --execute="echo 'Categorias antes de borrar: ' . App\Models\Categoria::count();"
Categorias antes de borrar: 5
```

### Ejecución de borrado en servidor (`DELETE /categorias/4`):
```text
  2026-11-19 10:52:15 /categorias ...................................................................................... ~ 511.89ms
  2026-11-19 10:52:29 /categorias/4 .................................................................................... ~ 515.64ms
  2026-11-19 10:52:29 /categorias ............................................................................................ ~ 1s
```

### Conteo después de eliminar la categoría:
```text
PS C:\laragon\www\mi-primera-app> php artisan tinker --execute="echo 'Categorias despues de borrar: ' . App\Models\Categoria::count();"
Categorias despues de borrar: 4
```

---

## 4. Evidencia de categoría editada
Se comprobó el flujo completo de edición sobre un registro existente en `/categorias/{id}/edit`:
1. Al pulsar **Editar** en el listado (`/categorias`), el sistema cargó la vista `categorias/edit.blade.php` precargando los valores actuales de `nombre` y `descripcion`.
2. Se probó la validación enviando campos inválidos, confirmando que el formulario conserva los valores ingresados (`old()`) y muestra la alerta de errores de Bootstrap.
3. Al guardar datos válidos mediante `PUT /categorias/{id}`, el registro se actualizó correctamente en la base de datos SQLite y redirigió al listado `/categorias` mostrando los cambios aplicados.

---

## 5. Archivos principales modificados / agregados
- `routes/web.php` (rutas `categorias.edit`, `categorias.update` y `categorias.destroy`)
- `app/Http/Controllers/CategoriaController.php` (métodos `edit`, `update`, `destroy` y validación reforzada)
- `resources/views/categorias/index.blade.php` (botones de **Editar** y **Borrar** por tarjeta)
- `resources/views/categorias/edit.blade.php` (formulario precargado con `@method('PUT')` y mensajes de error)
- `resources/views/categorias/create.blade.php` (validación y conservación de datos con `old()`)