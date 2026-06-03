<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataAuditLabs - Laravel</title>
    
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <a href="{{ session('usuario_id') ? route('tareas.index') : '#' }}">
                    <strong>DataAuditLabs</strong>
                </a>
            </div>
            
            <div class="menu-usuario">
                @if (session('usuario_nombre'))
                    <span class="nombre-usuario">
                        Hola, {{ session('usuario_nombre') }}
                    </span>
                    <a href="#" class="btn-logout">Cerrar Sesión</a>
                @else
                    <a href="#">Iniciar Sesión</a> | 
                    <a href="#">Registrarse</a>
                @endif
            </div>
        </nav>
    </header>
    
    <main class="contenedor">
        @yield('content')
    </main>
    
    <footer>
        <p>&copy; {{ date('Y') }} DataAuditLabs. Todos los derechos reservados.</p>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>