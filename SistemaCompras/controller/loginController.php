<?php 
    session_start();
    
    $usuarios = json_decode(file_get_contents('../mocks/usuarios.json'), true);

    $cracha = $_POST['numero-cracha'];

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