@extends('layouts.master')

@section('title', 'Administrar Pedidos')

@section('content')
<div class="container py-4">

    <h1 class="mb-4 text-center">📋 Administrar Pedidos</h1>

    {{-- Mensajes --}}
    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger text-center">
            {{ session('error') }}
        </div>
    @endif

    @if($pedidos->count() === 0)
        <div class="alert alert-info text-center">
            No hay pedidos registrados.
        </div>
    @else

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Origen</th>
                    <th>Fecha y Hora</th>
                    <th class="text-end">Total</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach($pedidos as $pedido)
                <tr>
                    <td>{{ $pedido->id }}</td>

                    <td>{{ $pedido->cliente }}</td>

                    <td>{{ $pedido->origen ?? '—' }}</td>

                    <td>
                        {{ \Carbon\Carbon::parse($pedido->fecha_hora)->format('d/m/Y H:i') }}
                    </td>

                    <td class="text-end">
                        ${{ number_format($pedido->total, 2) }}
                    </td>

                    <td class="text-center">

                        {{-- VER --}}
                        <a href="{{ route('pedidos.ver', $pedido->id) }}"
                           class="btn btn-sm btn-primary mb-1">
                            Ver
                        </a>

                        {{-- ELIMINAR --}}
                        <form action="{{ route('pedidos.eliminar', $pedido->id) }}"
                              method="POST"
                              class="d-inline"
                              onsubmit="return confirm('¿Seguro que deseas eliminar este pedido?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger mb-1">
                                Eliminar
                            </button>
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @endif

</div>
@endsection
