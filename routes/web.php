<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PedidoController;

// INICIO → PRODUCTOS
Route::get('/', [ProductoController::class, 'listar'])->name('home');

// PRODUCTOS
Route::get('/productos', [ProductoController::class, 'listar'])
    ->name('productos.listar');

// CARRITO (AJAX) - DEBEN SER POST
Route::post('/carrito/agregar', [PedidoController::class, 'agregar'])
    ->name('carrito.agregar');

Route::post('/carrito/quitar', [PedidoController::class, 'quitar'])
    ->name('carrito.quitar');

// HACER PEDIDO
Route::get('/pedidos/crear', [PedidoController::class, 'crear'])
    ->name('pedidos.crear');

// GUARDAR PEDIDO
Route::post('/pedidos/guardar', [PedidoController::class, 'guardar'])
    ->name('pedidos.guardar');

// VER PEDIDO
Route::get('/pedidos/ver/{id}', [PedidoController::class, 'ver'])
    ->name('pedidos.ver');

 
// ADMINISTRAR PEDIDOS (FASE 5)


// LISTAR TODOS LOS PEDIDOS
Route::get('/pedidos', [PedidoController::class, 'index'])
    ->name('pedidos.index');

// ELIMINAR PEDIDO
Route::delete('/pedidos/{id}', [PedidoController::class, 'destroy'])
    ->name('pedidos.destroy');
// ELIMINAR PEDIDO
Route::delete('/pedidos/eliminar/{id}', [PedidoController::class, 'eliminar'])
    ->name('pedidos.eliminar');
