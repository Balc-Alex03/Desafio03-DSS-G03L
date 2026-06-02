<?php
require_once 'models/TareaModel.php';

class TareasController {
    private $tareaModel;

    public function __construct() {
        $this->tareaModel = new TareaModel();
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
        $tareas = $this->tareaModel->obtenerPorUsuario($usuario_id);

        require_once 'views/tareas/index.php';
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
                $exito = $this->tareaModel->crear($usuario_id, $titulo, $descripcion);
                if ($exito) {
                    header('Location: index.php?controller=tareas&action=index');
                    exit();
                } else {
                    $error = "Hubo un error al guardar la tarea.";
                }
            }
        }

        require_once 'views/tareas/crear.php';
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
                $exito = $this->tareaModel->actualizar($id, $usuario_id, $titulo, $descripcion, $estado);
                if ($exito) {
                    header('Location: index.php?controller=tareas&action=index');
                    exit();
                } else {
                    $error = "No se pudo actualizar la tarea o no tienes permisos.";
                }
            }
        }

        $tarea = $this->tareaModel->obtenerPorId($id, $usuario_id);

        if (!$tarea) {
            die("Error 404: Tarea no encontrada o no tienes permisos para verla.");
        }

        require_once 'views/tareas/editar.php';
    }

    public function eliminar() {
        $this->verificarSesion();
        
        $id = $_GET['id'] ?? null;
        $usuario_id = $_SESSION['usuario_id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $id) {
            $this->tareaModel->eliminar($id, $usuario_id);
        }

        header('Location: index.php?controller=tareas&action=index');
        exit();
    }
}
?>