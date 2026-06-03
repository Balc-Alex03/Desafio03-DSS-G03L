<?php
class Database {
    public static function conectar() {
        $host = 'localhost';
        $user = 'root';
        $password = 'Depediex';
        $database = 'db_desafio03';
        $conexion = new mysqli($host, $user, $password, $database);

        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        $conexion->set_charset('utf8mb4');

        return $conexion;
    }
}

$conexion = Database::conectar();
?>