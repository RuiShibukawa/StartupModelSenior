<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../model/Usuario.php';

$usuarioModel = new Usuario();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["acao"]) && !empty($_POST["acao"])) {
    if ($_POST["acao"] == "create") {
        $nome = $_POST["nome-usuario"] ?? "";
        $cracha = $_POST["cracha-usuario"] ?? "";
        // Default to 'usuario' (1) if not specified
        $nivelAcesso = isset($_POST["nivel-usuario"]) ? ($_POST["nivel-usuario"] == "Administrador" || $_POST["nivel-usuario"] == "0" ? 0 : 1) : 1;
        
        if (!empty($nome) && !empty($cracha)) {
            $usuarioModel->create($nome, $cracha, $nivelAcesso);
        }
    }
    
    if ($_POST["acao"] == "update") {
        $id = $_POST["modal-id"] ?? null;
        $nome = $_POST["modal-nome"] ?? "";
        $cracha = $_POST["modal-cracha"] ?? "";
        $nivelAcessoStr = $_POST["modal-nivelAcesso"] ?? "";
        
        // Normalize the access level from text or value
        $nivelAcesso = (strcasecmp($nivelAcessoStr, "Administrador") === 0 || $nivelAcessoStr === "0") ? 0 : 1;
        
        if ($id && !empty($nome) && !empty($cracha)) {
            $usuarioModel->update($id, $nome, $cracha, $nivelAcesso);
        }
    }
    
    if ($_POST["acao"] == "delete") {
        $id = $_POST["id"] ?? null;
        if ($id) {
            $usuarioModel->delete($id);
        }
    }
    
    header("Location: usuarioController.php?acao=listAll");
    exit();
    
} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
    $acao = $_GET["acao"] ?? "listAll";
    if ($acao == "listAll") {
        $usuarios = $usuarioModel->listAll();
        include __DIR__ . '/../view/formUsuario.php';
        exit();
    }
}