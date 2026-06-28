<?php
require_once __DIR__ . '/../config/database.php';

class Categoria {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function listAll() {
        $stmt = $this->db->query("SELECT * FROM categorias ORDER BY id ASC");
        return $stmt->fetchAll();
    }

    public function create($nome) {
        $stmt = $this->db->prepare("INSERT INTO categorias (nome) VALUES (:nome)");
        return $stmt->execute([':nome' => $nome]);
    }

    public function update($id, $nome) {
        $stmt = $this->db->prepare("UPDATE categorias SET nome = :nome WHERE id = :id");
        return $stmt->execute([
            ':id' => $id,
            ':nome' => $nome
        ]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM categorias WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
