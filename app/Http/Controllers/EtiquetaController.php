<?php
namespace App\Http\Controllers;
use App\Models\Etiqueta;
class EtiquetaController extends Controller
{
    public function index()
    {
        return response()->json(Etiqueta::latest()->get());
    }
}