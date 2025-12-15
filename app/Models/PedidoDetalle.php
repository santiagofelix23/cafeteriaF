<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PedidoDetalle extends Model
{
    use HasFactory;

    protected $fillable = [
        'pedido_id',
        'producto_id',
        'cantidad',
        'precio_unitario',
        'subtotal'
    ];

    // ✅ RELACIÓN: CADA DETALLE PERTENECE A UN PRODUCTO
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }

    // (opcional pero correcto)
    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'pedido_id');
    }
}
