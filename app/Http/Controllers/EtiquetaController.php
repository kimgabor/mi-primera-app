<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etiqueta;

class EtiquetaController extends Controller
{
    public function index()
    {
        $etiquetas = Etiqueta::latest()->get();
        return view('etiquetas.index', ['etiquetas' => $etiquetas]);
    }

    public function create()
    {
        return view('etiquetas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|min:2|max:50',
            'color' => 'required|string|max:20',
        ]);

        Etiqueta::create([
            'nombre' => $request->input('nombre'),
            'color' => $request->input('color'),
        ]);

        return redirect()
            ->route('etiquetas.index')
            ->with('success', 'Etiqueta creada correctamente.');
    }
}