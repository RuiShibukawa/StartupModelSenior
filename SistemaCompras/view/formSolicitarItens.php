<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitações</title>
</head>
<body>
    <?php include_once "../layout/menu.php" ?>
    <main>
        <div id="selecao-itens" class="screen">
            <form action="../controller/solicitarItensController.php" method="post">
                <h1 class="titulo-view">Nova Solicitação de Itens</h1>
                <div class="data-cracha-solicitacao">
                    <div class="form-group">
                        <label>Data</label>
                        <span class="textoBloqueado"></span>
                    </div>
                    <div class="form-group">
                        <label>Seu Crachá</label>
                        <span class="textoBloqueado"></span>
                    </div>
                </div>
                <!-- <hr style="margin: 20px 0;"> -->
                <div class="form-group">
                    <label>Categoria (Filtro)</label>
                    <select>
                        <option>Informática</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Item</label>
                    <select>
                        <option>Teclado Mecânico ABNT2</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Quantidade/Gramas</label>
                    <input type="number" min="1">
                </div>
                <div class="form-group">
                    <label>Indicação de Turma (Opcional)</label>
                    <input type="text" placeholder="Ex: Turma A - Engenharia">
                </div>
                <!-- <div class="form-group">
                    <label>Observação</label>
                    <textarea rows="3"></textarea>
                </div> -->
                <div class="btn-group">
                    <button class="btn-add">INCLUIR NO PEDIDO</button>
                    <button class="btn-cancel">CANCELAR</button>
                </div>
            </form>
            <table>
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Usuário</th>
                        <th>Item</th>
                        <th>Quatidade</th>
                        <th>Unidade de Medida</th>
                        <th>Turma</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>17/05/2026</td>
                        <td>0123005</td>
                        <td>Mouse Óptico Dell</td>
                        <td>1</td>
                        <td>Unidade</td>
                        <td>2026/2</td>
                        <td><button class="btn-add" style="padding:5px">Alterar</button> <button class="btn-del" style="padding:5px">Excluir</button></td>
                    </tr>
                    <tr>
                        <td>17/05/2026</td>
                        <td>0123005</td>
                        <td>Teclado com fio Dell</td>
                        <td>1</td>
                        <td>Unidade</td>
                        <td>2026/2</td>
                        <td><button class="btn-add" style="padding:5px">Alterar</button> <button class="btn-del" style="padding:5px">Excluir</button></td>
                    </tr>
                </tbody>
            </table>
    
        </div>
    </main>
</body>
</html>