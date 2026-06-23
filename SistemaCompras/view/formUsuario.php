<?php 
    session_start();
    if(!isset($_SESSION['ususario'])){
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
    <link rel="stylesheet" href="../css/style.css">
    <title>Lista de Usuários</title>
</head>
<body>
    <?php 
        if($nivelAcesso == "Administrador"){
            include_once "../layout/menuAdm.php"; 
        }else {
            include_once "../layout/menu.php";    
        }
    ?>
    <main>
        <div id="cadastro-usuarios" class="screen">
            <form action="../controller/usuarioController.php" method="POST">
                <h1 class="titulo-view">Cadastro de Usuários</h1>
                <div class="form-group">
                    <label for="nome-usuario">Nome Completo</label>
                    <input type="text" name="nome-usuario" id="nome-usuario">
                </div>
                <div class="form-group">
                    <label for="cracha-usuario">Número do Crachá</label>
                    <input type="text" name="cracha-usuario" id="cracha-usuario">
                </div>
                <div class="form-group">
                    <label for="nivel-usuario">Nível de Acesso</label>
                    <select id="nivel-usuario">
                        <option>Usuário</option>
                        <option>Administrador</option>
                    </select>
                </div>
                <input type="hidden" name="acao" value="create">
                <div class="btn-group">
                    <button type="submit" class="btn-add">INCLUIR</button>
                </div>
            </form>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome completo</th>
                        <th>Numero crachá</th>
                        <th>Nível Acesso</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuario){ ?>

                        <tr>
                            <td><?= $usuario['id'] ?></td>
                            <td><?= $usuario['nome'] ?></td>
                            <td><?= $usuario['cracha'] ?></td>
                            <td><?= $usuario['nivelAcesso'] ?></td>
                            <td class="btn-group">
                                <button class="btn-update" 
                                    data-id="<?= $usuario['id'] ?>" 
                                    data-nome="<?= $usuario['nome'] ?>" 
                                    data-cracha="<?= $usuario['cracha'] ?>" 
                                    data-nivelAcesso="<?= $usuario['nivelAcesso'] ?>" 
                                    onclick="abrirModal(this)"
                                >Alterar</button> 

                                <form action="../controller/usuarioController.php" method="post">
                                    <input type="hidden" name="id" value="<?= $usuario['id']?>">
                                    <input type="hidden" name="acao" value="delete">
                                    <button type="submit" class="btn-del" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                                </form>
                            </td>
                        </tr>

                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>
    <script>
        function abrirModal(botao) {
            const id = botao.getAttribute('data-id');
            const nome = botao.getAttribute('data-nome');
            const cracha = botao.getAttribute('data-cracha');
            const nivelAcesso = botao.getAttribute('data-nivelAcesso');

            document.getElementById('modal-id').value = id;
            document.getElementById('modal-nome').value = nome;
            document.getElementById('modal-cracha').value = cracha;
            document.getElementById('modal-nivelAcesso').value = nivelAcesso;

            document.getElementById('modal').style.display = 'block';
        }

        function fecharModal() {
            document.getElementById('modal').style.display = 'none';
        }
    </script>
</body>
<form action="../controller/usuarioController.php" method="POST" id="modal">
    <div id="modal-container">
        <h3>Alterar Usuario</h3>
        <div>
            <input type="hidden" name="modal-id" id="modal-id">

            <label for="modal-nome">Nome</label>
            <input type="text" name="modal-nome" id="modal-nome">
            <label for="modal-cracha">Crachá</label>
            <input type="text" name="modal-cracha" id="modal-cracha">
            <label for="modal-nivelAcesso">Nível de acesso</label>
            <input type="text" name="modal-nivelAcesso" id="modal-nivelAcesso">

            <br><br>
            <input type="hidden" name="acao" value="update">
            
            <button class="btn-add" type="submit" value="Atualizar">Salvar</button>
            <button class="btn-cancel" type="button" onclick="fecharModal()">Cancelar</button>
        </div >
    </div>
</form>
</html>