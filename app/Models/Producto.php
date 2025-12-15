<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'precio',
        'imagen'
    ];

    // ¡COMENTA o ELIMINA ESTO TEMPORALMENTE!
    // public function pedidoDetalles()
    // {
    //     return $this->hasMany(PedidoDetalle::class);
    // }
}