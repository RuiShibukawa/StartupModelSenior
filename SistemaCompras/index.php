<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>Sistema de Pedidos - login</title>
    </head>
    <body>
        <main id="login" class="screen active">
            <form action="" id="login-container">
                <h1>Acesso ao Sistema</h1>
                <div class="form-group">
                    <label>Nome do Usuário</label>
                    <input type="text" placeholder="Digite seu nome">
                </div>
                <div class="form-group">
                    <label>Número do Crachá</label>
                    <input type="number" placeholder="000000">
                </div>
                <button class="btn-login" onclick="login()">Logar</button>
            </form>    
        </main>
    </body>
</html>