<?php require_once 'views/layout/header.php'; ?>

<div class="form-box">
    <h2>Editar Tarea</h2>

    <?php if (!empty($error)): ?>
        <div class="error-alerta">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="index.php?controller=tareas&action=editar&id=<?= $tarea['id'] ?>">
        <div class="form-group">
            <label for="titulo">Título de la Tarea:</label>
            <input type="text" id="titulo" name="titulo" value="<?= htmlspecialchars($tarea['titulo']) ?>" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" rows="5"><?= htmlspecialchars($tarea['descripcion']) ?></textarea>
        </div>

        <div class="form-group">
            <label for="estado">Estado Actual:</label>
            <select id="estado" name="estado" required>
                <option value="pendiente" <?= $tarea['estado'] === 'pendiente' ? 'selected' : '' ?>>Pendiente</option>
                <option value="en_progreso" <?= $tarea['estado'] === 'en_progreso' ? 'selected' : '' ?>>En Progreso</option>
                <option value="completada" <?= $tarea['estado'] === 'completada' ? 'selected' : '' ?>>Completada</option>
            </select>
        </div>

        <div class="form-botones">
            <button type="submit" class="btn-guardar">Actualizar Tarea</button>
            <a href="index.php?controller=tareas&action=index" class="btn-cancelar">Cancelar</a>
        </div>
    </form>
</div>

<?php require_once 'views/layout/footer.php'; ?>