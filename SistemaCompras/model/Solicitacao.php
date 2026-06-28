<?php
require_once __DIR__ . '/../config/database.php';

class Solicitacao {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function listAll() {
        $sql = "SELECT s.*, u.nome as usuario_nome, u.cracha as usuario_cracha, u.nivel_acesso as usuario_nivel,
                       i.nome as item_nome, i.unidade_medida as item_unidade, i.categoria_id, c.nome as categoria_nome,
                       i.quantidade as estoque_atual
                FROM solicitacoes s
                JOIN usuarios u ON s.usuario_id = u.id
                JOIN itens i ON s.item_id = i.id
                JOIN categorias c ON i.categoria_id = c.id
                ORDER BY s.id DESC";
        $stmt = $this->db->query($sql);
        $solicitacoes = [];
        while ($row = $stmt->fetch()) {
            $solicitacoes[] = $this->formatRow($row);
        }
        return $solicitacoes;
    }

    public function listByUsuario($usuario_id) {
        $sql = "SELECT s.*, u.nome as usuario_nome, u.cracha as usuario_cracha, u.nivel_acesso as usuario_nivel,
                       i.nome as item_nome, i.unidade_medida as item_unidade, i.categoria_id, c.nome as categoria_nome,
                       i.quantidade as estoque_atual
                FROM solicitacoes s
                JOIN usuarios u ON s.usuario_id = u.id
                JOIN itens i ON s.item_id = i.id
                JOIN categorias c ON i.categoria_id = c.id
                WHERE s.usuario_id = :usuario_id
                ORDER BY s.id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':usuario_id' => $usuario_id]);
        $solicitacoes = [];
        while ($row = $stmt->fetch()) {
            $solicitacoes[] = $this->formatRow($row);
        }
        return $solicitacoes;
    }

    public function getById($id) {
        $sql = "SELECT s.*, u.nome as usuario_nome, u.cracha as usuario_cracha, u.nivel_acesso as usuario_nivel,
                       i.nome as item_nome, i.unidade_medida as item_unidade, i.categoria_id, c.nome as categoria_nome,
                       i.quantidade as estoque_atual
                FROM solicitacoes s
                JOIN usuarios u ON s.usuario_id = u.id
                JOIN itens i ON s.item_id = i.id
                JOIN categorias c ON i.categoria_id = c.id
                WHERE s.id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        if ($row = $stmt->fetch()) {
            return $this->formatRow($row);
        }
        return null;
    }

    public function create($usuario_id, $item_id, $quantidade, $turma, $observacao = null) {
        $stmt = $this->db->prepare("INSERT INTO solicitacoes (usuario_id, item_id, quantidade, turma, observacao, status) VALUES (:usuario_id, :item_id, :quantidade, :turma, :observacao, 'em_espera')");
        return $stmt->execute([
            ':usuario_id' => $usuario_id,
            ':item_id' => $item_id,
            ':quantidade' => $quantidade,
            ':turma' => $turma,
            ':observacao' => $observacao
        ]);
    }

    public function updateStatus($id, $status) {
        $stmt = $this->db->prepare("UPDATE solicitacoes SET status = :status WHERE id = :id");
        return $stmt->execute([
            ':id' => $id,
            ':status' => $status
        ]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM solicitacoes WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    private function formatRow($row) {
        $date = new DateTime($row['data_solicitacao']);
        $formattedDate = $date->format('d/m/Y');
        
        $statusDisplay = 'Espera';
        if ($row['status'] === 'aprovado') {
            $statusDisplay = 'Aprovado';
        } elseif ($row['status'] === 'reprovado') {
            $statusDisplay = 'Reprovado';
        }

        $nivelAcesso = ($row['usuario_nivel'] === 'administrador') ? 0 : 1;

        return [
            'id' => $row['id'],
            'data' => $formattedDate,
            'status' => $statusDisplay,
            'status_db' => $row['status'],
            'usuario' => [
                'id' => $row['usuario_id'],
                'nome' => $row['usuario_nome'],
                'cracha' => $row['usuario_cracha'],
                'nivelAcesso' => $nivelAcesso
            ],
            'item' => [
                'id' => $row['item_id'],
                'descricao' => $row['item_nome'],
                'categoria' => [
                    'id' => $row['categoria_id'],
                    'nome' => $row['categoria_nome']
                ],
                'quantidade' => (float)$row['quantidade'],
                'estoque_atual' => (float)$row['estoque_atual'],
                'unidadeMedida' => $row['item_unidade']
            ],
            'turma' => $row['turma'],
            'observacao' => $row['observacao']
        ];
    }
}
