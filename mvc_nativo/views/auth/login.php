<?php require_once 'views/layout/header.php'; ?>

<div class="auth-box">
    <h2>Iniciar Sesión</h2>

    <?php if (!empty($error)): ?>
        <div class="error-alerta">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="index.php?controller=auth&action=login">
        <div class="form-group">
            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="email" required placeholder="ejemplo@correo.com">
        </div>

        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required placeholder="Ingresa tu contraseña">
        </div>

        <button type="submit" class="btn-submit">Ingresar</button>
    </form>

    <div class="auth-footer">
        <p>¿No tienes cuenta? <a href="index.php?controller=auth&action=registro">Regístrate aquí</a></p>
    </div>
</div>

<?php require_once 'views/layout/footer.php'; ?>