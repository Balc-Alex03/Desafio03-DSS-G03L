<?php require_once 'views/layout/header.php'; ?>

<div class="form-box">
    <h2>Crear Nueva Tarea</h2>

    <?php if (!empty($error)): ?>
        <div class="error-alerta">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="index.php?controller=tareas&action=crear">
        <div class="form-group">
            <label for="titulo">Título de la Tarea:</label>
            <input type="text" id="titulo" name="titulo" required placeholder="Ej. Redactar informe técnico">
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción (Opcional):</label>
            <textarea id="descripcion" name="descripcion" rows="5" placeholder="Describe brevemente los detalles de la tarea..."></textarea>
        </div>

        <div class="form-botones">
            <button type="submit" class="btn-guardar">Guardar Tarea</button>
            <a href="index.php?controller=tareas&action=index" class="btn-cancelar">Cancelar</a>
        </div>
    </form>
</div>

<?php require_once 'views/layout/footer.php'; ?>