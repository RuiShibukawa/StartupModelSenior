<main id="login" class="screen active">
    <!-- <form action="./controller/controller.php" id="login-container" method="POST"> -->
    <form action="./view/home.php" id="login-container" method="POST">
        <h1>Acesso ao Sistema</h1>
        <div class="form-group">
            <label>Nome do Usuário</label>
            <input type="text" placeholder="Digite seu nome">
        </div>
        <div class="form-group">
            <label>Número do Crachá</label>
            <input type="number" placeholder="000000">
        </div>
        <input type="submit" value="Login" class="btn-login">
    </form>    
</main>