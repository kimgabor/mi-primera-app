<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HolaController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\EtiquetaController;
use App\Http\Controllers\ContactoController;

Route::get('/', function () {
    return redirect()->route('posts.index');
});

Route::get('/hola', [HolaController::class, 'saludoSimple']);
Route::get('/hola/{nombre}', [HolaController::class, 'saludoConNombre']);

Route::get('/posts', [PostsController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostsController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostsController::class, 'store'])->name('posts.store');
Route::get('/posts/{id}/edit', [PostsController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{id}', [PostsController::class, 'update'])->name('posts.update');
Route::delete('/posts/{id}', [PostsController::class, 'destroy'])->name('posts.destroy');

Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
Route::get('/categorias/create', [CategoriaController::class, 'create'])->name('categorias.create');
Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store');
Route::get('/categorias/{id}', [CategoriaController::class, 'show'])->name('categorias.show');
Route::get('/categorias/{id}/edit', [CategoriaController::class, 'edit'])->name('categorias.edit');
Route::put('/categorias/{id}', [CategoriaController::class, 'update'])->name('categorias.update');
Route::delete('/categorias/{id}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');

Route::get('/etiquetas', [EtiquetaController::class, 'index'])->name('etiquetas.index');
Route::get('/etiquetas/create', [EtiquetaController::class, 'create'])->name('etiquetas.create');
Route::post('/etiquetas', [EtiquetaController::class, 'store'])->name('etiquetas.store');

Route::get('/contacto', [ContactoController::class, 'index'])->name('contacto.index');
Route::get('/contacto/create', [ContactoController::class, 'create'])->name('contacto.create');
Route::post('/contacto', [ContactoController::class, 'store'])->name('contacto.store');