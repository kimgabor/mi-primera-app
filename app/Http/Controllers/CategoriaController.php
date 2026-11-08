<?php
namespace App\Http\Controllers;
use App\Models\Categoria;
class CategoriaController extends Controller
{ public function index()
    {return response()->json(Categoria::latest()->get());}
    public function show($id)
    {return response()->json(Categoria::find($id));}
}