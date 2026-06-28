<?php
require_once __DIR__ . '/../config/database.php';

class Itens {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function listAll() {
        $sql = "SELECT i.*, c.nome as categoria_nome 
                FROM itens i 
                JOIN categorias c ON i.categoria_id = c.id 
                ORDER BY i.id ASC";
        $stmt = $this->db->query($sql);
        $itens = [];
        while ($row = $stmt->fetch()) {
            $itens[] = [
                'id' => $row['id'],
                'descricao' => $row['nome'], // Map db 'nome' to view 'descricao'
                'categoria' => [
                    'id' => $row['categoria_id'],
                    'nome' => $row['categoria_nome']
                ],
                'quantidade' => (float)$row['quantidade'],
                'unidadeMedida' => $row['unidade_medida']
            ];
        }
        return $itens;
    }

    public function create($nome, $categoria_id, $quantidade, $unidade_medida) {
        $stmt = $this->db->prepare("INSERT INTO itens (nome, descricao, categoria_id, quantidade, unidade_medida) VALUES (:nome, :descricao, :categoria_id, :quantidade, :unidade_medida)");
        return $stmt->execute([
            ':nome' => $nome,
            ':descricao' => $nome,
            ':categoria_id' => $categoria_id,
            ':quantidade' => $quantidade,
            ':unidade_medida' => $unidade_medida
        ]);
    }

    public function update($id, $nome, $categoria_id, $quantidade, $unidade_medida) {
        $stmt = $this->db->prepare("UPDATE itens SET nome = :nome, descricao = :descricao, categoria_id = :categoria_id, quantidade = :quantidade, unidade_medida = :unidade_medida WHERE id = :id");
        return $stmt->execute([
            ':id' => $id,
            ':nome' => $nome,
            ':descricao' => $nome,
            ':categoria_id' => $categoria_id,
            ':quantidade' => $quantidade,
            ':unidade_medida' => $unidade_medida
        ]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM itens WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    public function deductStock($id, $quantidade) {
        $stmt = $this->db->prepare("UPDATE itens SET quantidade = GREATEST(0, quantidade - :quantidade) WHERE id = :id");
        return $stmt->execute([
            ':id' => $id,
            ':quantidade' => $quantidade
        ]);
    }
}
