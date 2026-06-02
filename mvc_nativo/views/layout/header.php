<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataAuditLabs</title>
    <link rel="stylesheet" href="/DataAuditLabs/mvc_nativo/public/css/style.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <a href="<?= isset($_SESSION['usuario_id']) ? 'index.php?controller=tareas&action=index' : 
                'index.php?controller=auth&action=login' ?>">
                    <strong>DataAuditLabs</strong>
                </a>
            </div>
            
            <div class="menu-usuario">
                <?php if (isset($_SESSION['usuario_nombre'])): ?>
                    <span class="nombre-usuario">
                        Hola, <?= htmlspecialchars($_SESSION['usuario_nombre']) ?>
                    </span>
                    <a href="index.php?controller=auth&action=logout" class="btn-logout">Cerrar Sesión</a>
                <?php else: ?>
                    <a href="index.php?controller=auth&action=login">Iniciar Sesión</a> | 
                    <a href="index.php?controller=auth&action=registro">Registrarse</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>
    
    <main class="contenedor">