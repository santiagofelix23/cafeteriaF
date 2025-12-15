@extends('layouts.master')

@section('title', 'Productos')

@push('styles')
<style>
    .producto-card {
        border-radius: 12px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 4px 10px rgba(0,0,0,.1);
        transition: transform .2s;
        height: 100%;
    }

    .producto-card:hover {
        transform: scale(1.02);
    }

    .producto-img {
        width: 100%;
        height: 180px;
        object-fit: cover;
    }

    .producto-body {
        padding: 12px;
        text-align: center;
    }

    .producto-precio {
        color: #198754;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .contador {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 12px;
    }

    .contador button {
        width: 36px;
        height: 36px;
        font-size: 20px;
        line-height: 0;
    }

    .cantidad {
        font-size: 18px;
        font-weight: bold;
        min-width: 20px;
        text-align: center;
    }
</style>
@endpush

@section('content')

<div class="row g-4">
    @foreach ($productos as $producto)
        <div class="col-md-4 col-lg-3">
            <div class="producto-card" data-id="{{ $producto->id }}">
                <img
                    src="{{ asset('img/productos/' . $producto->imagen) }}"
                    class="producto-img"
                    alt="{{ $producto->nombre }}"
                >

                <div class="producto-body">
                    <h6 class="fw-bold">{{ $producto->nombre }}</h6>
                    <div class="producto-precio">
                        ${{ number_format($producto->precio, 2) }}
                    </div>

                    {{-- CONTADOR --}}
                    <div class="contador">
                        <button class="btn btn-danger btn-menos">−</button>
                        <span class="cantidad">0</span>
                        <button class="btn btn-success btn-mas">+</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", () => {
    // Cargar cantidades iniciales del carrito
    @php
        $carritoSession = session('carrito', []);
    @endphp
    
    const carrito = @json($carritoSession);
    
    document.querySelectorAll(".producto-card").forEach(card => {
        const productoId = card.dataset.id;
        const btnMas = card.querySelector(".btn-mas");
        const btnMenos = card.querySelector(".btn-menos");
        const cantidadSpan = card.querySelector(".cantidad");
        
        // Cargar cantidad inicial del carrito
        let cantidad = carrito[productoId]?.cantidad || 0;
        cantidadSpan.textContent = cantidad;

        // Botón SUMAR (+)
        btnMas.addEventListener("click", () => {
            fetch("{{ route('carrito.agregar') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ id: productoId })
            })
            .then(response => response.json())
            .then(data => {
                cantidad = data.cantidad;
                cantidadSpan.textContent = cantidad;
            });
        });

        // Botón RESTAR (-)
        btnMenos.addEventListener("click", () => {
            fetch("{{ route('carrito.quitar') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ id: productoId })
            })
            .then(response => response.json())
            .then(data => {
                cantidad = data.cantidad;
                cantidadSpan.textContent = cantidad;
            });
        });
    });
});
</script>
@endpush