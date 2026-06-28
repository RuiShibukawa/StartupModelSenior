<?php 
    session_start();
    if(!isset($_SESSION['usuario'])){
        header('Location: formLogin.php');
        exit();
    }
    $usuario = $_SESSION['usuario'];
    $cracha = $_SESSION['cracha'];
    $nivelAcesso = $_SESSION['nivelAcesso'];
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sistema de Pedidos</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <?php 
            if($nivelAcesso === 0){
                include_once "../layout/menuAdm.php"; 
            }else {
                include_once "../layout/menu.php";    
            }
        ?>
        <main>
            <h1 class="titulo-view">Sistema de Controle de Compras</h1>
            <h2 class="subtitulo-home">Seja bem vindo <?= $usuario ?></h2>
        </main>
    </body>
</html>