@extends('layouts.master')

@section('title', 'Pedido Confirmado')

@section('content')

<div class="container">
    <div class="text-center mb-4">
        <div class="alert alert-success">
            <h2>¡Pedido Confirmado Exitosamente!</h2>
        </div>
    </div>

    <div class="card shadow-lg border-0">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Recibo del Pedido #{{ $pedido->id }}</h4>
        </div>
        <div class="card-body">
            <!-- Información del pedido -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <p><strong>Cliente:</strong> {{ $pedido->cliente }}</p>
                    @if($pedido->origen)
                        <p><strong>Origen:</strong> {{ $pedido->origen }}</p>
                    @endif
                </div>
                <div class="col-md-6">
                    <p><strong>Fecha y Hora:</strong> {{ $pedido->fecha_hora->format('d/m/Y H:i') }}</p>
                    <small class="text-muted">(Registrado automáticamente)</small>
                </div>
            </div>

            <!-- Tabla de productos -->
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Producto</th>
                            <th class="text-center">Precio Unitario</th>
                            <th class="text-center">Cantidad</th>
                            <th class="text-center">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pedido->detalles as $detalle)
                            <tr>
                                <td>{{ $detalle->producto->nombre }}</td>
                                <td class="text-center">${{ number_format($detalle->precio_unitario, 2) }}</td>
                                <td class="text-center">{{ $detalle->cantidad }}</td>
                                <td class="text-center">${{ number_format($detalle->subtotal, 2) }}</td>
                            </tr>
                        @endforeach
                        
                        <!-- Total -->
                        <tr class="table-success">
                            <td colspan="3" class="text-end fw-bold">TOTAL:</td>
                            <td class="text-center fw-bold">${{ number_format($pedido->total, 2) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Botones de acción -->
            <div class="text-center mt-4">
                <a href="{{ route('productos.listar') }}" class="btn btn-primary">
                    Hacer otro pedido
                </a>
            </div>
        </div>
    </div>
</div>

@endsection