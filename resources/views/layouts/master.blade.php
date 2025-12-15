<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Cafetería Escolar')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Estilos personalizados -->
    <style>
        /* COLORES PRINCIPALES */
        :root {
            --color-vino: #481220;
            --color-fondo: #e5e4e2;
            --color-footer: #343a40;
        }
        
        /* FONDO DE TODA LA PÁGINA */
        body {
            background-color: var(--color-fondo) !important;
            color: #333;
        }
        
        /* NAVEGACIÓN */
        .navbar.bg-primary {
            background-color: var(--color-vino) !important;
        }
        
        /* BOTONES PRIMARIOS */
        .btn-primary {
            background-color: var(--color-vino);
            border-color: var(--color-vino);
        }
        
        .btn-primary:hover {
            background-color: #3a0e1a;
            border-color: #3a0e1a;
        }
        
        /* ENCABEZADOS DE CARD */
        .card-header.bg-primary {
            background-color: var(--color-vino) !important;
        }
        
        /* TABLAS */
        .table-dark {
            background-color: var(--color-vino) !important;
        }
        
        thead.bg-primary {
            background-color: var(--color-vino) !important;
        }
        
        /* CONTENEDOR PRINCIPAL */
        main.container {
            background-color: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            margin-top: 20px;
            margin-bottom: 20px;
        }
        
        /* FOOTER (mantiene el oscuro) */
        footer.bg-dark {
            background-color: var(--color-footer) !important;
        }
    </style>

    <!-- Estilos extra de las vistas -->
    @stack('styles')
</head>
<body class="d-flex flex-column min-vh-100">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('productos.listar') }}">
            Cafetería Escolar
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('productos.listar') }}">
                        Inicio
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pedidos.crear') }}">
                        Hacer Pedido
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pedidos.index') }}" class="nav-link">
    Administrar
</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- =========================
     CONTENIDO
========================= -->
<main class="container my-4 flex-grow-1">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @yield('content')

</main>

<!-- =========================
     FOOTER
========================= -->
<footer class="bg-dark text-light text-center py-3 mt-auto">
    <small>
        © {{ date('Y') }} Cafetería Escolar | Proyecto Laravel
    </small>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')

</body>
</html>