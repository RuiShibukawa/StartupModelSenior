<?php 
    session_start();
    require_once __DIR__ . '/../model/Usuario.php';
    $usuarioModel = new Usuario();
    $usuarios = $usuarioModel->listAll();

    $cracha = $_POST['numero-cracha'] ?? null;

    foreach ($usuarios as $usuario) {
        if($cracha == $usuario['cracha']){
            //cria sessao
            $_SESSION['usuario'] = $usuario['nome'];
            $_SESSION['cracha'] = $usuario['cracha'];
            $_SESSION['nivelAcesso'] = $usuario['nivelAcesso'];
            
            // redireciona
            header("Location: ../view/home.php");
            exit();
        } else {
            header("Location: ../view/formLogin.php?msg=error");
        } 
    }                 
?>