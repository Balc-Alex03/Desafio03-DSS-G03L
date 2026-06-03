<?php
require_once __DIR__ . '/../models/TareasModel.php';

class TareasController {
    private $tareasModel;

    public function __construct() {
        $this->tareasModel = new TareasModel();
    }

    private function verificarSesion() {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: index.php?controller=auth&action=login');
            exit();
        }
    }

    public function index() {
        $this->verificarSesion();
        
        $usuario_id = $_SESSION['usuario_id'];
        $tareas = $this->tareasModel->obtenerPorUsuario($usuario_id);

        require_once __DIR__ . '/../views/tareas/index.php';
    }

    public function crear() {
        $this->verificarSesion();
        
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo = trim($_POST['titulo'] ?? '');
            $descripcion = trim($_POST['descripcion'] ?? '');
            $usuario_id = $_SESSION['usuario_id'];

            if (empty($titulo)) {
                $error = "El título de la tarea es obligatorio.";
            } else {
                $exito = $this->tareasModel->crear($usuario_id, $titulo, $descripcion);
                if ($exito) {
                    header('Location: index.php?controller=tareas&action=index');
                    exit();
                } else {
                    $error = "Hubo un error al guardar la tarea.";
                }
            }
        }

        require_once __DIR__ . '/../views/tareas/crear.php';
    }

    public function editar() {
        $this->verificarSesion();
        
        $error = null;
        $id = $_GET['id'] ?? null;
        $usuario_id = $_SESSION['usuario_id'];

        if (!$id) {
            header('Location: index.php?controller=tareas&action=index');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo = trim($_POST['titulo'] ?? '');
            $descripcion = trim($_POST['descripcion'] ?? '');
            $estado = trim($_POST['estado'] ?? 'pendiente');

            if (empty($titulo)) {
                $error = "El título no puede quedar vacío.";
            } else {
                $exito = $this->tareasModel->actualizar($id, $usuario_id, $titulo, $descripcion, $estado);
                if ($exito) {
                    header('Location: index.php?controller=tareas&action=index');
                    exit();
                } else {
                    $error = "No se pudo actualizar la tarea o no tienes permisos.";
                }
            }
        }

        $tarea = $this->tareasModel->obtenerPorId($id, $usuario_id);

        if (!$tarea) {
            die("Error 404: Tarea no encontrada o no tienes permisos para verla.");
        }

        require_once __DIR__ . '/../views/tareas/editar.php';
    }

    public function eliminar() {
        $this->verificarSesion();
        
        $id = $_GET['id'] ?? null;
        $usuario_id = $_SESSION['usuario_id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $id) {
            $this->tareasModel->eliminar($id, $usuario_id);
        }

        header('Location: index.php?controller=tareas&action=index');
        exit();
    }
}
?>