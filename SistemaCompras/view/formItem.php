<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Itens</title>
</head>
<body>
    <?php include_once "../layout/menu.php"; ?>
    <main>
        <div id="cadastro-itens" class="screen">
            <form action="../controller/itemController.php" method="post">
                <h1 class="titulo-view">Cadastro de Itens</h1>
                <div class="form-group">
                    <label for="descricao-item">Descrição</label>
                    <input type="text" name="descricao-item" id="descricao-item" placeholder="Ex: Mouse Óptico Dell">
                </div>
                <div class="form-group">
                    <label for="select-categoria">Categoria</label>
                    <select id="select-categoria" name="select-categoria">
                        <?php foreach ($categorias as $categoria){ ?>
                            <option value="<?= $categoria['id'] ?>"><?= $categoria['nome'] ?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="quantidade-item">Quantidade</label>
                    <input type="text" id="quantidade-item" placeholder="Ex: 1000">
                </div>
                <div class="form-group">
                    <label for="unidadeMedida-item">Unidade de medida</label>
                    <select name="unidadeMedida-item" id="unidadeMedida-item">
                        <option value="">Gramas</option>
                        <option value="">Unidade</option>
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
                        <th>Descrição</th>
                        <th>Categoria</th>
                        <th>Quatidade</th>
                        <th>Unidade de Medida</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($itens as $item){ ?>
                        <tr>
                            <td><?= $item['id'] ?></td>
                            <td><?= $item['descricao']?></td>
                            <td><?= $item['categoria']['nome']?></td>
                            <td><?= $item['quantidade']?></td>
                            <td><?= $item['unidadeMedida']?></td>
                            <td class="btn-group">

                                <button class="btn-update" 
                                    dado-id="<?= $item['id'] ?>" 
                                    dado-descricao="<?= $item['descricao'] ?>" 
                                    dado-categoria="<?= $item['categoria']?>"
                                    dado-quantidade="<?= $item['quantidade']?>"
                                    dado-unidadeMedida="<?= $item['unidadeMedida']?>"
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
            const id = botao.getAttribute('dado-id');
            const descricao = botao.getAttribute('dado-descricao');
            const categoria = botao.getAttribute('dado-categoria');
            const quantidade = botao.getAttribute('dado-quantidade');
            const unidadeMedida = botao.getAttribute('dado-unidadeMedida');

            document.getElementById('modal-id').value = id;
            document.getElementById('modal-descricao').value = descricao;
            document.getElementById('modal-categoria').value = categoria;
            document.getElementById('modal-quantidade').value = quantidade;
            document.getElementById('modal-unidadeMedida').value = unidadeMedida;

            document.getElementById('modal').style.display = 'block';
        }

        function fecharModal() {
            document.getElementById('modal').style.display = 'none';
        }
    </script>
</body>
<form action="../controller/itemController.php" method="POST" id="modal">
    <div id="modal-container">
        <h3>Alterar Item</h3>
        <div>
            <input type="hidden" name="modal-id" id="modal-id">

            <label for="modal-descricao">Descrição</label>
            <input type="text" name="modal-descricao" id="modal-descricao">
            
            <label for="modal-categoria">Categoria</label>
            <select id="modal-categoria" name="modal-categoria">
                <?php foreach ($categorias as $categoria){ ?>
                    <option value="<?= $categoria['id'] ?>"><?= $categoria['nome'] ?></option>
                <?php }?>
            </select>
            
            <label for="modal-quantidade">Quantidade</label>
            <input type="text" name="modal-quantidade" id="modal-quantidade">
            
            <label for="modal-unidadeMedida">Unidade Medida</label>
            <select name="modal-unidadeMedida" id="modal-unidadeMedida">
                <option value="">Gramas</option>
                <option value="">Unidade</option>
            </select>
            
            <br><br>
            <input type="hidden" name="acao" value="update">
            
            <button class="btn-add" type="submit" value="Atualizar">Salvar</button>
            <button class="btn-cancel" type="button" onclick="fecharModal()">Cancelar</button>
        </div >
    </div>
</form>
</html>