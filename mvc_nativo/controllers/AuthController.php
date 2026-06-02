<?php
require_once 'models/UsuarioModel.php';

class AuthController {
    private $usuarioModel;

    public function __construct() {
        $this->usuarioModel = new UsuarioModel();
    }

    public function login() {
        if (isset($_SESSION['usuario_id'])) {
            header('Location: index.php?controller=tareas&action=index');
            exit();
        }

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if (empty($email) || empty($password)) {
                $error = "Todos los campos son obligatorios.";
            } else {
                $usuario = $this->usuarioModel->buscarPorEmail($email);

                if ($usuario && password_verify($password, $usuario['password'])) {
                    $_SESSION['usuario_id'] = $usuario['id'];
                    $_SESSION['usuario_nombre'] = $usuario['nombre'];
                    $_SESSION['usuario_email'] = $usuario['email'];

                    header('Location: index.php?controller=tareas&action=index');
                    exit();
                } else {
                    $error = "Correo electrónico o contraseña incorrectos.";
                }
            }
        }

        require_once 'views/auth/login.php';
    }

    public function registro() {
        if (isset($_SESSION['usuario_id'])) {
            header('Location: index.php?controller=tareas&action=index');
            exit();
        }

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if (empty($nombre) || empty($email) || empty($password)) {
                $error = "Todos los campos son obligatorios.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "El formato del correo electrónico no es válido.";
            } else {
                $exito = $this->usuarioModel->crear($nombre, $email, $password);

                if ($exito) {
                    header('Location: index.php?controller=auth&action=login');
                    exit();
                } else {
                    $error = "El correo electrónico ya está registrado o hubo un error en el sistema.";
                }
            }
        }

        require_once 'views/auth/registro.php';
    }

    public function logout() {
        $_SESSION = [];

        if (ini_get("session_use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();

        header('Location: index.php?controller=auth&action=login');
        exit();
    }
}
?>