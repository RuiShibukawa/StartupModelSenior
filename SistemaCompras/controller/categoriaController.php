<?php

require_once __DIR__ . '/../model/Categoria.php';

$categoriaModel = new Categoria();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["acao"]) && !empty($_POST["acao"])) {
    if ($_POST["acao"] == "create") {
        $nome = $_POST["nome-categoria"] ?? "";
        if (!empty($nome)) {
            $categoriaModel->create($nome);
        }
    }
    
    if ($_POST["acao"] == "update") {
        $id = $_POST["modal-id"] ?? null;
        $nome = $_POST["modal-nome"] ?? "";
        if ($id && !empty($nome)) {
            $categoriaModel->update($id, $nome);
        }
    }
    
    if ($_POST["acao"] == "delete") {
        $id = $_POST["id"] ?? null;
        if ($id) {
            $categoriaModel->delete($id);
        }
    }
    
    header("Location: categoriaController.php?acao=listAll");
    exit();
    
} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
    $acao = $_GET["acao"] ?? "listAll";
    if ($acao == "listAll") {
        $categorias = $categoriaModel->listAll();
        include __DIR__ . '/../view/formCategoria.php';
        exit();
    }
}