<?php


require_once __DIR__ . '/../model/Itens.php';
require_once __DIR__ . '/../model/Categoria.php';

$itemModel = new Itens();
$categoriaModel = new Categoria();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["acao"]) && !empty($_POST["acao"])) {
    if ($_POST["acao"] == "create") {
        $nome = trim($_POST["descricao-item"] ?? "");
        $categoria_id = $_POST["select-categoria"] ?? null;
        $quantidade = $_POST["quantidade-item"] ?? 0;
        $quantidade = str_replace(',', '.', $quantidade);
        $unidade_medida = $_POST["unidadeMedida-item"] ?? "";
        
        if (!empty($nome) && $categoria_id && is_numeric($quantidade)) {
            $itemModel->create($nome, $categoria_id, $quantidade, $unidade_medida);
        }
    }
    
    if ($_POST["acao"] == "update") {
        $id = $_POST["modal-id"] ?? null;
        $nome = trim($_POST["modal-descricao"] ?? "");
        $categoria_id = $_POST["modal-categoria"] ?? null;
        $quantidade = $_POST["modal-quantidade"] ?? 0;
        $quantidade = str_replace(',', '.', $quantidade);
        $unidade_medida = $_POST["modal-unidadeMedida"] ?? "";
        
        if ($id && !empty($nome) && $categoria_id && is_numeric($quantidade)) {
            $itemModel->update($id, $nome, $categoria_id, $quantidade, $unidade_medida);
        }
    }
    
    if ($_POST["acao"] == "delete") {
        $id = $_POST["id"] ?? null;
        if ($id) {
            $itemModel->delete($id);
        }
    }
    
    header("Location: itemController.php?acao=listAll");
    exit();
    
} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
    $acao = $_GET["acao"] ?? "listAll";
    if ($acao == "listAll") {
        $itens = $itemModel->listAll();
        $categorias = $categoriaModel->listAll();
        include __DIR__ . '/../view/formItem.php';
        exit();
    }
}
