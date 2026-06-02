<?php require_once 'views/layout/header.php'; ?>

<div class="auth-box">
    <h2>Crear Cuenta</h2>

    <?php if (!empty($error)): ?>
        <div class="error-alerta">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="index.php?controller=auth&action=registro">
        <div class="form-group">
            <label for="nombre">Nombre Completo:</label>
            <input type="text" id="nombre" name="nombre" required placeholder="Tu nombre y apellido">
        </div>

        <div class="form-group">
            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="email" required placeholder="ejemplo@correo.com">
        </div>

        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required placeholder="Mínimo 6 caracteres">
        </div>

        <button type="submit" class="btn-submit">Registrarme</button>
    </form>

    <div class="auth-footer">
        <p>¿Ya tienes una cuenta? <a href="index.php?controller=auth&action=login">Inicia sesión aquí</a></p>
    </div>
</div>

<?php require_once 'views/layout/footer.php'; ?>