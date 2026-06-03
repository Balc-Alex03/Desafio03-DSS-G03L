<?php
session_start();

header('Content-Type: application/json');

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/TareasModel.php';

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['exito' => false, 'mensaje' => 'No autorizado. Debes iniciar sesión.']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['id'] ?? null;
    $estado = $_POST['estado'] ?? null;
    $usuario_id = $_SESSION['usuario_id'];

    $estados_validos = ['pendiente', 'en_progreso', 'completada'];

    if (!$id || !in_array($estado, $estados_validos)) {
        echo json_encode(['exito' => false, 'mensaje' => 'Datos inválidos o estado no reconocido.']);
        exit();
    }

    $tareasModel = new TareasModel();
    $exito = $tareasModel->actualizarEstado($id, $usuario_id, $estado);

    if ($exito) {
        echo json_encode(['exito' => true]);
    } else {
        echo json_encode(['exito' => false, 'mensaje' => 'Error al actualizar en la base de datos.']);
    }
} else {
    echo json_encode(['exito' => false, 'mensaje' => 'Método no permitido.']);
}
?>