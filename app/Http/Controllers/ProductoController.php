<?php

namespace App\Http\Controllers;

use App\Models\Producto;

class ProductoController extends Controller
{
    public function listar()
    {
        $productos = Producto::all();
        return view('productos.listar', compact('productos'));
    }
}
