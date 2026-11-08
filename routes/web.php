<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HolaController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\EtiquetaController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/hola', [HolaController::class, 'saludoSimple']);
Route::get('/hola/{nombre}', [HolaController::class, 'saludoConNombre']);
Route::get('/posts', [PostsController::class, 'index'])->name('posts.index');
Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
Route::get('/categorias/{id}', [CategoriaController::class, 'show'])->name('categorias.show');
Route::get('/etiquetas', [EtiquetaController::class, 'index'])->name('etiquetas.index');