<?php
require_once __DIR__ . '/../config/database.php';

class Usuario {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function listAll() {
        $stmt = $this->db->query("SELECT * FROM usuarios ORDER BY id ASC");
        $usuarios = [];
        while ($row = $stmt->fetch()) {
            // Map 'administrador' -> 0, 'usuario' -> 1 to match the mock/view expectations
            $nivelAcesso = ($row['nivel_acesso'] === 'administrador') ? 0 : 1;
            $usuarios[] = [
                'id' => $row['id'],
                'nome' => $row['nome'],
                'cracha' => $row['cracha'],
                'nivelAcesso' => $nivelAcesso,
                'criado_em' => $row['criado_em']
            ];
        }
        return $usuarios;
    }

    public function getByCracha($cracha) {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE cracha = :cracha");
        $stmt->execute([':cracha' => $cracha]);
        $row = $stmt->fetch();
        if ($row) {
            $nivelAcesso = ($row['nivel_acesso'] === 'administrador') ? 0 : 1;
            return [
                'id' => $row['id'],
                'nome' => $row['nome'],
                'cracha' => $row['cracha'],
                'nivelAcesso' => $nivelAcesso,
                'criado_em' => $row['criado_em']
            ];
        }
        return null;
    }

    public function create($nome, $cracha, $nivelAcessoVal) {
        $nivelAcesso = ($nivelAcessoVal == 0) ? 'administrador' : 'usuario';
        $stmt = $this->db->prepare("INSERT INTO usuarios (nome, cracha, nivel_acesso) VALUES (:nome, :cracha, :nivel_acesso)");
        return $stmt->execute([
            ':nome' => $nome,
            ':cracha' => $cracha,
            ':nivel_acesso' => $nivelAcesso
        ]);
    }

    public function update($id, $nome, $cracha, $nivelAcessoVal) {
        $nivelAcesso = ($nivelAcessoVal == 0) ? 'administrador' : 'usuario';
        $stmt = $this->db->prepare("UPDATE usuarios SET nome = :nome, cracha = :cracha, nivel_acesso = :nivel_acesso WHERE id = :id");
        return $stmt->execute([
            ':id' => $id,
            ':nome' => $nome,
            ':cracha' => $cracha,
            ':nivel_acesso' => $nivelAcesso
        ]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM usuarios WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
