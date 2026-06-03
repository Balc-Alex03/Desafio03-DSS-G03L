<?php
class TareasModel {
    private $db;

    public function __construct() {
        $this->db = Database::conectar();
    }

    public function obtenerPorUsuario($usuario_id) {
        $sql = "SELECT * FROM tareas WHERE usuario_id = ? ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        
        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();
        
        $resultado = $stmt->get_result();
        $tareas = [];
        
        while ($fila = $resultado->fetch_assoc()) {
            $tareas[] = $fila;
        }
        
        $stmt->close();
        return $tareas;
    }

    public function crear($usuario_id, $titulo, $descripcion) {
        $sql = "INSERT INTO tareas (usuario_id, titulo, descripcion) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        
        $stmt->bind_param("iss", $usuario_id, $titulo, $descripcion);
        
        $resultado = $stmt->execute();
        $stmt->close();
        
        return $resultado;
    }

    public function obtenerPorId($id, $usuario_id) {
        $sql = "SELECT * FROM tareas WHERE id = ? AND usuario_id = ? LIMIT 1";
        $stmt = $this->db->prepare($sql);
        
        $stmt->bind_param("ii", $id, $usuario_id);
        $stmt->execute();
        
        $resultado = $stmt->get_result();
        $tarea = $resultado->fetch_assoc();
        
        $stmt->close();
        return $tarea;
    }

    public function actualizar($id, $usuario_id, $titulo, $descripcion, $estado) {
        $sql = "UPDATE tareas SET titulo = ?, descripcion = ?, estado = ? WHERE id = ? AND usuario_id = ?";
        $stmt = $this->db->prepare($sql);
        
        $stmt->bind_param("sssii", $titulo, $descripcion, $estado, $id, $usuario_id);
        
        $resultado = $stmt->execute();
        $stmt->close();
        
        return $resultado;
    }

    public function actualizarEstado($id, $usuario_id, $estado) {
        $sql = "UPDATE tareas SET estado = ? WHERE id = ? AND usuario_id = ?";
        $stmt = $this->db->prepare($sql);
        
        $stmt->bind_param("sii", $estado, $id, $usuario_id);
        
        $resultado = $stmt->execute();
        $stmt->close();
        
        return $resultado;
    }

    public function eliminar($id, $usuario_id) {
        $sql = "DELETE FROM tareas WHERE id = ? AND usuario_id = ?";
        $stmt = $this->db->prepare($sql);
        
        $stmt->bind_param("ii", $id, $usuario_id);
        
        $resultado = $stmt->execute();
        $stmt->close();
        
        return $resultado;
    }
}
?>