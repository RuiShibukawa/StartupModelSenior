<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Login</title>
</head>
<body>
    <main id="login">
        <?php if(isset($_GET["msg"])){
            if($_GET["msg"] == "error"){
                ?>
                    <div class="mensagem-error">
                        <p>Número do crachá não encontrado!</p>
                        <p>Entrar em contato com o administrador para cadastro do usuário</p>
                    </div>
                <?php
            }
        }?>
        <form action="../controller/loginController.php" id="login-container" method="POST">
            <h1 class="titulo-login">Acesso ao Sistema</h1>
            <div class="form-group">
                <label for="">Número do Crachá</label>
                <input type="number" placeholder="000000" id="numero-cracha" name="numero-cracha">
            </div>
            <input type="submit" value="Login" class="btn-login">
        </form>    
    </main>
</body>
</html>


