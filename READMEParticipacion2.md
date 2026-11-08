# Actividad por Participación 2 - Blog de Game Concept Design Sinceramenete este archivo README lo hizo Gem, no sabia como agregor todo al readme :c

## Tema del Blog

Blog centrado en el **Diseño y Concepto de Videojuegos**, abarcando desde las etapas de arte conceptual e ilustración hasta el prototipado rápido y el diseño de niveles con una estética visual neón.

## 5.1 Hoja de modelado (`Categoria`)

| Campo | Tipo | Ejemplo | Para qué sirve |
| :--- | :--- | :--- | :--- |
| `nombre` | `string` | "Concept Art" | El nombre corto que verá el lector en el blog. |
| `descripcion` | `text` | "Diseño visual inicial, ilustraciones..." | Explica qué tipo de contenido agrupa la categoría. |
| `color` | `string` | "#FF007F" | Código de color neón para distinguir visualmente la categoría. |

## Conteo en Tinker

Salida del comando `App\Models\Categoria::count();` en la consola de Tinker:

```text
= 3
```

## Salida de `route:list`

Salida de `php artisan route:list --path=categorias`:

```text
GET|HEAD   categorias .................................... categorias.index › CategoriaController@index
```

## Respuesta JSON de `/categorias`

Obtenida mediante `curl.exe http://127.0.0.1:8000/categorias`:

```json
[
  {
    "id": 3,
    "nombre": "Level Design",
    "descripcion": "Construcción y maquetación de escenarios, flujo de mapas y ritmo del jugador a través de la aventura",
    "color": "#00F0FF",
    "created_at": "2026-11-05T15:19:28.000000Z",
    "updated_at": "2026-11-05T15:19:28.000000Z"
  },
  {
    "id": 2,
    "nombre": "Prototipado",
    "descripcion": "Pruebas rápidas y borradores jugables para comprobar si la idea del juego es divertida antes de diseñarlo completo",
    "color": "#00FF66",
    "created_at": "2026-11-05T15:19:17.000000Z",
    "updated_at": "2026-11-05T15:19:17.000000Z"
  },
  {
    "id": 1,
    "nombre": "Concept Art",
    "descripcion": "Diseño visual inicial, ilustraciones de personajes, entornos y paletas de color para definir el estilo del juego",
    "color": "#FF007F",
    "created_at": "2026-11-05T15:18:26.000000Z",
    "updated_at": "2026-11-05T15:18:26.000000Z"
  }
]
```

## Explicación del Recorrido (Flujo de la Solicitud)

1. **Ruta:** La solicitud entra a través de la URL `/categorias`, la cual es procesada por `routes/web.php` e identificada bajo el nombre `categorias.index`.
2. **Controlador:** La ruta redirige la atención al método `index()` dentro de `CategoriaController.php`.
3. **Modelo & JSON:** El controlador hace la consulta `Categoria::latest()->get()` para obtener los registros guardados en SQLite, los cuales son serializados y devueltos automáticamente en formato JSON al cliente.