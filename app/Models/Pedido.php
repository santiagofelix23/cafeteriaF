<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente',
        'origen',
        'fecha_hora',
        'total'
    ];

    protected $casts = [
        'fecha_hora' => 'datetime',
    ];

    // ✅ RELACIÓN: UN PEDIDO TIENE MUCHOS DETALLES
    public function detalles()
    {
        return $this->hasMany(PedidoDetalle::class, 'pedido_id');
    }
}
