<?php

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["acao"]) && !empty($_POST["acao"])){
        if($_POST["acao"] == "create"){
            echo("Solicitação criada");
        }
        if($_POST["acao"] == "update"){
            echo("solicitação atualizada");
        }
        if($_POST["acao"] == "delete"){
            echo("solicitação excluída");
        }
    }
    elseif($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["acao"]) && !empty($_GET["acao"])){
        if($_GET["acao"] == "listAll"){
            $solicitacoes = json_decode(file_get_contents('../mocks/solicitacao.json'), true);
            $categorias = json_decode(file_get_contents('../mocks/categorias.json'), true);
            $itens = json_decode(file_get_contents('../mocks/itens.json'), true);
            include '../view/formSolicitarItens.php';
        }
    }

?>