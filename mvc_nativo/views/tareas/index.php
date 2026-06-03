<?php require_once 'views/layout/header.php'; ?>

<div class="dashboard-header">
    <h2>Mis Tareas</h2>
    <a href="index.php?controller=tareas&action=crear" class="btn-nueva">+ Nueva Tarea</a>
</div>

<?php if (empty($tareas)): ?>
    <div class="sin-tareas">
        <p>No tienes tareas aún. ¡Comienza creando una nueva!</p>
    </div>
<?php else: ?>
    <div class="listado-tareas">
        <?php foreach ($tareas as $tarea): ?>
            <div class="tarea-card">
                <div class="tarea-contenido">
                    <h3><?= htmlspecialchars($tarea['titulo']) ?></h3>
                    <p><?= nl2br(htmlspecialchars($tarea['descripcion'])) ?></p>
                    
                    <div class="btns-estado" data-id="<?= $tarea['id'] ?>">
                        <button class="btn-estado <?= $tarea['estado'] === 'pendiente' ? 'activo' : '' ?>" 
                                data-estado="pendiente">Pendiente</button>
                                
                        <button class="btn-estado <?= $tarea['estado'] === 'en_progreso' ? 'activo' : '' ?>" 
                                data-estado="en_progreso">En Progreso</button>
                                
                        <button class="btn-estado <?= $tarea['estado'] === 'completada' ? 'activo' : '' ?>" 
                                data-estado="completada">Completada</button>
                    </div>
                </div>
                
                <div class="tarea-acciones">
                    <a href="index.php?controller=tareas&action=editar&id=<?= $tarea['id'] ?>" class="btn-editar">Editar</a>
                    
                    <form method="POST" action="index.php?controller=tareas&action=eliminar&id=<?= $tarea['id'] ?>" class="form-eliminar" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta tarea?');">
                        <button type="submit" class="btn-eliminar">Eliminar</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php require_once 'views/layout/footer.php'; ?>