<?php

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["acao"]) && !empty($_POST["acao"])){
        if($_POST["acao"] == "create"){
            echo("usuário criado");
        }
        if($_POST["acao"] == "update"){
            echo("usuário atualizado");
        }
        if($_POST["acao"] == "delete"){
            echo("usuário excluído");
        }
    }elseif($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["acao"]) && !empty($_GET["acao"])){
        if($_GET["acao"] == "listAll"){
            $usuarios = json_decode(file_get_contents('../mocks/usuarios.json'), true);
            include '../view/formUsuario.php';
        }
    }

?>