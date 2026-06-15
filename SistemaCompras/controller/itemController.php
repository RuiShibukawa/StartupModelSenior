<?php

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["acao"]) && !empty($_POST["acao"])){
        if($_POST["acao"] == "create"){
            echo("categoria criada");
        }
        if($_POST["acao"] == "update"){
            echo("categoria atualizada");
        }
        if($_POST["acao"] == "delete"){
            echo("categoria excluída");
        }
    }elseif($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["acao"]) && !empty($_GET["acao"])){
        if($_GET["acao"] == "listAll"){
            $itens = json_decode(file_get_contents('../mocks/itens.json'), true);
            $categorias = json_decode(file_get_contents('../mocks/categorias.json'), true);
            include '../view/formItem.php';
        }
    }

?>