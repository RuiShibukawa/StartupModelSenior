<?php

require_once __DIR__ . '/../model/Solicitacao.php';
require_once __DIR__ . '/../model/Usuario.php';
require_once __DIR__ . '/../model/Itens.php';
require_once __DIR__ . '/../model/Categoria.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$solicitacaoModel = new Solicitacao();
$usuarioModel = new Usuario();
$itemModel = new Itens();
$categoriaModel = new Categoria();

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["acao"]) && !empty($_POST["acao"])){
    if($_POST["acao"] == "create"){
        $cracha = $_SESSION['cracha'] ?? null;

        if (empty($cracha) && isset($_POST["cracha-inclusao"])) {
            if (is_array($_POST["cracha-inclusao"])) {
                $cracha = $_POST["cracha-inclusao"][0] ?? null;
            } else {
                $cracha = $_POST["cracha-inclusao"];
            }
        }

        $usuario = $cracha ? $usuarioModel->getByCracha($cracha) : null;
        $usuario_id = $usuario['id'] ?? null;

        $itensSolicitados = $_POST["itemId-inclusao"] ?? [];
        $quantidadesSolicitadas = $_POST["quantidade-inclusao"] ?? [];
        $turmasSolicitadas = $_POST["turma-inclusao"] ?? [];

        if (!is_array($itensSolicitados)) {
            $itensSolicitados = [$itensSolicitados];
        }
        if (!is_array($quantidadesSolicitadas)) {
            $quantidadesSolicitadas = [$quantidadesSolicitadas];
        }
        if (!is_array($turmasSolicitadas)) {
            $turmasSolicitadas = [$turmasSolicitadas];
        }

        if ($usuario_id && !empty($itensSolicitados)) {
            foreach ($itensSolicitados as $indice => $item_id) {
                $quantidade = $quantidadesSolicitadas[$indice] ?? 0;
                $quantidade = str_replace(',', '.', $quantidade);
                $turma = $turmasSolicitadas[$indice] ?? null;
                $turma = trim((string)$turma);
                $turma = $turma !== '' ? $turma : null;

                if (!empty($item_id) && is_numeric($quantidade) && $quantidade > 0) {
                    $solicitacaoModel->create($usuario_id, $item_id, $quantidade, $turma);
                }
            }
        }

        header("Location: solicitarItensController.php?acao=listAll");
        exit();
    }
    if($_POST["acao"] == "update"){
        echo("solicitação atualizada");
    }
    if($_POST["acao"] == "delete"){
        $id = $_POST["id"] ?? null;
        if ($id) {
            $solicitacaoModel->delete($id);
        }
        header("Location: solicitarItensController.php?acao=listAll");
        exit();
    }
}
elseif($_SERVER["REQUEST_METHOD"] == "GET"){
    $acao = $_GET["acao"] ?? "listAll";
    if($acao == "listAll"){
        $solicitacoes = $solicitacaoModel->listAll();
        $categorias = $categoriaModel->listAll();
        $itens = $itemModel->listAll();
        include __DIR__ . '/../view/formSolicitarItens.php';
        exit();
    }
}

?>
