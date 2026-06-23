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
    <link rel="stylesheet" href="../css/style.css">
    <title>Lista de Categorias</title>
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
        <div id="cadastro-categoria" class="screen">
            <form action="../controller/categoriaController.php" method="POST">
                <h1 class="titulo-view">Cadastro de Categorias</h1>
                <div class="form-group">
                    <label for="nome-categoria">Nome</label>
                    <input type="text" name="nome-categoria" id = "nome-categoria" placeholder="Ex: Informática, Limpeza">
                </div>
                <input type="hidden" name="acao" value="create">
                <div class="btn-group">
                    <button type="submit" class="btn-add">INCLUIR</input>
                </div>
            </form>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categorias as $item){ ?>
                        <tr>
                            <td><?= $item['id'] ?></td>
                            <td><?= $item['nome']?></td>
                            <td class="btn-group">

                                <button class="btn-update" 
                                    data-id="<?= $item['id'] ?>" 
                                    data-nome="<?= $item['nome'] ?>" 
                                    onclick="abrirModal(this)"
                                >Alterar</button> 

                                <form action="../controller/categoriaController.php" method="post">
                                    <input type="hidden" name="id" value="<?= $item['id']?>">
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

            document.getElementById('modal-id').value = id;
            document.getElementById('modal-nome').value = nome;

            document.getElementById('modal').style.display = 'block';
        }

        function fecharModal() {
            document.getElementById('modal').style.display = 'none';
        }

    </script>
</body>
<form action="../controller/categoriaController.php" method="POST" id="modal">
    <div id="modal-container">
        <h3>Alterar Categoria</h3>
        <div>
            <input type="hidden" name="modal-id" id="modal-id">

            <label for="modal-nome">Nome</label>
            <input type="text" name="modal-nome" id="modal-nome">

            <br><br>
            <input type="hidden" name="acao" value="update">
            
            <button class="btn-add" type="submit" value="Atualizar">Salvar</button>
            <button class="btn-cancel" type="button" onclick="fecharModal()">Cancelar</button>
        </div >
    </div>
</form>
</html>
