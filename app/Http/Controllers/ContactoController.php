<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contacto;

class ContactoController extends Controller
{
    public function index()
    {
        $mensajes = Contacto::latest()->get();
        return view('contacto.index', ['mensajes' => $mensajes]);
    }
    public function create()
    {
        return view('contacto.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|min:3|max:100',
            'email' => 'required|email|max:150',
            'mensaje' => 'required|string|min:10',
        ]);
        Contacto::create([
            'nombre' => $request->input('nombre'),
            'email' => $request->input('email'),
            'mensaje' => $request->input('mensaje'),
        ]);

        return redirect()
            ->route('contacto.index')
            ->with('success', 'Mensaje de contacto enviado correctamente.');
    }
}