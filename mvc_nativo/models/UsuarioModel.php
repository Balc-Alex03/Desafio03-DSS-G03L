<?php

class UsuarioModel {
    private $db;

public function __construct() {
    $this->db = Database::conectar();
}

    public function crear($nombre, $email, $password) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            return false;
        }

        $stmt->bind_param("sss", $nombre, $email, $passwordHash);

        $resultado = $stmt->execute();
        
        $stmt->close();

        return $resultado;
    }

    public function buscarPorEmail($email) {
        $sql = "SELECT * FROM usuarios WHERE email = ? LIMIT 1";
        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            return null;
        }

        $stmt->bind_param("s", $email);

        $stmt->execute();
        $resultado = $stmt->get_result();

        $usuario = $resultado->fetch_assoc();
        
        $stmt->close();

        return $usuario;
    }
}
?>