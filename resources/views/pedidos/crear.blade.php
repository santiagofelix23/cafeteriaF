@extends('layouts.master')

@section('title', 'Confirmar Pedido')

@section('content')
<div class="container py-4">
    <h1 class="mb-2 text-center">Confirmar Pedido</h1>

    {{-- FECHA Y HORA LOCAL (MAZATLÁN) --}}
    <div class="text-center text-muted mb-4">
        📅 Fecha y hora del pedido:
        <strong>{{ now()->timezone('America/Mazatlan')->format('d/m/Y h:i A') }}</strong>
    </div>

    @if(count($carrito) === 0)
        <div class="alert alert-warning text-center">
            <p class="mb-3">No hay productos en el carrito.</p>
            <a href="{{ route('productos.listar') }}" class="btn btn-primary">
                Ver Productos
            </a>
        </div>
    @else

    <!-- Botón para seguir comprando -->
    <div class="mb-3">
        <a href="{{ route('productos.listar') }}" class="btn btn-outline-primary btn-sm">
            ← Seleccionar más productos
        </a>
    </div>

    <!-- Tabla de productos -->
    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Resumen del Pedido</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Producto</th>
                            <th class="text-center">Cantidad</th>
                            <th class="text-center">Precio Unitario</th>
                            <th class="text-center">Subtotal</th>
                            <th class="text-center">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach($carrito as $id => $item)
                            @php
                                $subtotal = $item['precio'] * $item['cantidad'];
                                $total += $subtotal;
                            @endphp
                            <tr data-id="{{ $id }}">
                                <td>{{ $item['nombre'] }}</td>
                                <td class="text-center">
                                    <span class="cantidad">{{ $item['cantidad'] }}</span>
                                </td>
                                <td class="text-center">
                                    ${{ number_format($item['precio'], 2) }}
                                </td>
                                <td class="text-center">
                                    ${{ number_format($subtotal, 2) }}
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        <button type="button" class="btn btn-danger restar">−</button>
                                        <button type="button" class="btn btn-success sumar">+</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="table-success">
                            <td colspan="3" class="text-end fw-bold">TOTAL DEL PEDIDO:</td>
                            <td class="text-center fw-bold" colspan="2">
                                ${{ number_format($total, 2) }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <!-- Formulario de datos del cliente -->
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Datos del Cliente</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('pedidos.guardar') }}">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Nombre *</label>
                        <input type="text" name="cliente" class="form-control"
                               placeholder="Escribe tu nombre" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Origen (opcional)</label>
                        <input type="text" name="origen" class="form-control"
                               placeholder="Ej: Salon, Grupo, etc.">
                    </div>
                </div>

                {{-- FECHA SE GUARDA AUTOMÁTICAMENTE EN EL CONTROLADOR --}}

                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                    <button type="submit" class="btn btn-success btn-lg">
                        <img src="{{ asset('img/jimbo.png') }}" alt="jimbo"
                             style="width: 24px; height: 24px; margin-right: 8px;">
                        Grabar Pedido - ${{ number_format($total, 2) }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    @endif
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {

    function actualizarCantidad(id, accion) {
        const url = accion === 'sumar'
            ? "{{ route('carrito.agregar') }}"
            : "{{ route('carrito.quitar') }}";

        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ id: id })
        })
        .then(() => location.reload())
        .catch(error => console.error(error));
    }

    document.querySelectorAll('.sumar').forEach(btn => {
        btn.addEventListener('click', function() {
            actualizarCantidad(this.closest('tr').dataset.id, 'sumar');
        });
    });

    document.querySelectorAll('.restar').forEach(btn => {
        btn.addEventListener('click', function() {
            actualizarCantidad(this.closest('tr').dataset.id, 'restar');
        });
    });
});
</script>
@endpush
