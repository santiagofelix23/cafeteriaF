<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Pedido;
use App\Models\PedidoDetalle;

class PedidoController extends Controller
{
    // ==========================
    // MOSTRAR VISTA "HACER PEDIDO"
    // ==========================
    public function crear()
    {
        $carrito = session('carrito', []);
        return view('pedidos.crear', compact('carrito'));
    }

    // ==========================
    // AGREGAR PRODUCTO AL CARRITO
    // ==========================
    public function agregar(Request $request)
    {
        $id = $request->id;
        $producto = Producto::findOrFail($id);

        $carrito = session('carrito', []);

        if (isset($carrito[$id])) {
            $carrito[$id]['cantidad']++;
        } else {
            $carrito[$id] = [
                'nombre' => $producto->nombre,
                'precio' => $producto->precio,
                'cantidad' => 1,
            ];
        }

        session()->put('carrito', $carrito);

        return response()->json(['cantidad' => $carrito[$id]['cantidad']]);
    }

    // ==========================
    // QUITAR PRODUCTO DEL CARRITO
    // ==========================
    public function quitar(Request $request)
    {
        $id = $request->id;
        $carrito = session('carrito', []);

        if (!isset($carrito[$id])) {
            return response()->json(['cantidad' => 0]);
        }

        $carrito[$id]['cantidad']--;

        if ($carrito[$id]['cantidad'] <= 0) {
            unset($carrito[$id]);
        }

        session()->put('carrito', $carrito);

        return response()->json([
            'cantidad' => $carrito[$id]['cantidad'] ?? 0
        ]);
    }

    // ==========================
    // GUARDAR PEDIDO EN BASE DE DATOS (FECHA AUTOMÁTICA)
    // ==========================
    public function guardar(Request $request)
    {        $carrito = session('carrito', []);
    
        if (count($carrito) == 0) {
            return redirect()->route('pedidos.crear')
                            ->with('error', 'El carrito está vacío. Agrega productos primero.');
        }
        
       $request->validate([
            'cliente' => 'required|min:2|max:100',
            'origen' => 'nullable|max:50'
        ]);
            
        $pedido = Pedido::create([
            'cliente' => $request->cliente,
            'origen' => $request->origen,
            'fecha_hora' => now(), 
            'total' => 0
        ]);
        
        $total = 0;
        
                foreach ($carrito as $id => $item) {
            $subtotal = $item['precio'] * $item['cantidad'];
            
            PedidoDetalle::create([
                'pedido_id' => $pedido->id,
                'producto_id' => $id,
                'cantidad' => $item['cantidad'],
                'precio_unitario' => $item['precio'],
                'subtotal' => $subtotal
            ]);
            
            $total += $subtotal;
        }
        
        $pedido->update(['total' => $total]);
        
       session()->forget('carrito');
        
       return redirect()->route('pedidos.ver', $pedido->id)
                         ->with('success', '¡Pedido confirmado exitosamente!');
    }

    // ==========================
    // VER PEDIDO CONFIRMADO
    // ==========================
    public function ver($id)
    {
        $pedido = Pedido::with('detalles.producto')->findOrFail($id);
        return view('pedidos.ver', compact('pedido'));
    }
    // ==========================
// LISTAR PEDIDOS (FASE 5)
// ==========================
public function index()
{
    // Obtener pedidos ordenados del más reciente al más antiguo
    $pedidos = Pedido::orderBy('created_at', 'desc')->get();

    return view('pedidos.index', compact('pedidos'));
}
// ==========================
// ELIMINAR PEDIDO
// ==========================
public function eliminar($id)
{
    try {
        // Eliminar detalles primero
        PedidoDetalle::where('pedido_id', $id)->delete();

        // Eliminar pedido
        Pedido::where('id', $id)->delete();

        return redirect()->route('pedidos.index')
            ->with('success', 'Pedido eliminado correctamente');

    } catch (\Exception $e) {
        return redirect()->route('pedidos.index')
            ->with('error', 'Error al eliminar el pedido');
    }
}

}