<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Categoria;
class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::latest()->get();
        return view('categorias.index', ['categorias' => $categorias]);
    }
    public function create()
    {
        return view('categorias.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'required|string',
        ]);
        Categoria::create([
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion'),
        ]);
        return redirect()
            ->route('categorias.index')
            ->with('success', 'Categoría creada correctamente.');
    }
    public function show($id)
    {
        $categoria = Categoria::findOrFail($id);
        return response()->json($categoria);
    }
}