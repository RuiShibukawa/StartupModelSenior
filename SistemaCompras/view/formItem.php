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
            <form action="../controller/itemController" method="post">
                <h1>Cadastro de Itens</h1>
                <div class="form-group">
                    <label for="descricao-item">Descrição</label>
                    <input type="text" id="descricao-item" placeholder="Ex: Mouse Óptico Dell">
                </div>
                <div class="form-group">
                    <label for="select-categoria">Categoria</label>
                    <select id="select-categoria">
                        <option>Informática</option>
                        <option>Limpeza</option>
                        <option>Escritório</option>
                        <option>Tempero</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="quantidade-item">Quantidade</label>
                    <input type="text" id="quantidade-item" placeholder="Ex: 1000">
                </div>
                <div class="form-group">
                    <label for="unidade-medida-item">Unidade de medida</label>
                    <select name="" id="unidade-medida-item">
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
                    <tr>
                        <td>1</td>
                        <td>Mouse Óptico Dell</td>
                        <td>Informática</td>
                        <td>2</td>
                        <td>Unidade</td>
                        <td><button class="btn-add" style="padding:5px">Alterar</button> <button class="btn-del" style="padding:5px">Excluir</button></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Teclado com fio Dell</td>
                        <td>Informática</td>
                        <td>1</td>
                        <td>Unidade</td>
                        <td><button class="btn-add" style="padding:5px">Alterar</button> <button class="btn-del" style="padding:5px">Excluir</button></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Sal do Himalaia</td>
                        <td>Tempero</td>
                        <td>1000</td>
                        <td>Gramas</td>
                        <td><button class="btn-add" style="padding:5px">Alterar</button> <button class="btn-del" style="padding:5px">Excluir</button></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Açúcar Demerara</td>
                        <td>Tempero</td>
                        <td>5000</td>
                        <td>Gramas</td>
                        <td><button class="btn-add" style="padding:5px">Alterar</button> <button class="btn-del" style="padding:5px">Excluir</button></td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
    </main>

</body>
</html>