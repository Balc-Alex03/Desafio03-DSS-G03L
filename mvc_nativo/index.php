<?php
session_start();
require_once 'config/Database.php';

$controllerInput = $_GET['controller'] ?? 'auth';
$action = $_GET['action'] ?? 'login';

$controllerClass = ucfirst($controllerInput) . 'Controller';
$controllerFile = 'controllers/' . $controllerClass . '.php';

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    
    if (class_exists($controllerClass)) {
        $controller = new $controllerClass();
        
        if (method_exists($controller, $action)) {
            $controller->$action();
        } else {
            die("Error 404: La acción '{$action}' no existe en {$controllerClass}.");
        }
    } else {
        die("Error: La clase '{$controllerClass}' no está definida en el archivo.");
    }
} else {
    die("Error 404: El controlador '{$controllerClass}' no fue encontrado.");
}
?>