<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
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
    <title>Solicitações</title>
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
        <div id="selecao-itens" class="screen">
            <section>
                <h1 class="titulo-view">Nova Solicitação de Itens</h1>
                <div class="data-cracha-solicitacao">
                    <div class="form-group">
                        <label>Data</label>
                        <span class="textoBloqueado" id="data-solicitarItens" value="<?= date('d/m/Y')?>"><?= date('d/m/Y')?></span>
                    </div>
                    <div class="form-group">
                        <label>Seu Crachá</label>
                        <span class="textoBloqueado" id="cracha-solicitarItens" value="<?= htmlspecialchars($cracha) ?>"><?= htmlspecialchars($cracha) ?></span>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <label for="select-categoria-solicitarItens">Categoria</label>
                    <select id="select-categoria-solicitarItens" name="select-categoria-solicitarItens" onchange="filtrarItens()">
                        <option value="">Selecione uma categoria</option>
                        <?php foreach ($categorias as $categoria){ ?>
                            <option value="<?= htmlspecialchars($categoria['id']) ?>"><?= htmlspecialchars($categoria['nome']) ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Item</label>
                    <select name="select-item-solicitarItens" id="select-item-solicitarItens">
                        <option value="">Selecione um item</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Quantidade</label>
                    <input type="number" min="1" id="quantidade-item" name="quantidade-item">
                </div>
                <div class="form-group">
                    <label for="turma-item">Indicação de Turma (Opcional)</label>
                    <input type="text" placeholder="Ex: Turma A - Engenharia" id="turma-item" name="turma-item">
                </div>
                <div class="btn-group">
                    <button type="button" class="btn-add" id="incluir-item-solicitarItens">INCLUIR NO PEDIDO</button>
                </div>
            </section>
            <form action="../controller/solicitarItensController.php" method="post">
                <input type="hidden" name="acao" value="create">
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
                    <tbody id="tabela-de-itens">

                    </tbody>
                </table>
                <button class="btn-add" type="submit" onclick="return validarSolicitacao()">Solicitar</button>
            </form>
    
        </div>
    </main>
    <script>
        const itens = <?php echo json_encode($itens, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT); ?>;

        function filtrarItens(){
            const categoriaSelecionada = document.getElementById("select-categoria-solicitarItens").value;
            const selectItens = document.getElementById("select-item-solicitarItens");

            //limpa opções
            selectItens.innerHTML = '<option value="">-- Selecione um item --</option>';
            
            //filtra e adiciona
            itens.forEach(item => {
                if(item.categoria.id == categoriaSelecionada){
                    let option = document.createElement("option");
                    option.value = item.id;
                    option.text = item.descricao;

                    option.setAttribute("data-unidade", item.unidadeMedida);

                    selectItens.appendChild(option);
                }
            });
        }

        function validarSolicitacao(){
            const listaDeItens = document.getElementById("tabela-de-itens");
            if(listaDeItens.children.length === 0){
                alert("Inclua pelo menos um item no pedido antes de solicitar.");
                return false;
            }
            return true;
        }

        document.getElementById("select-item-solicitarItens").addEventListener("change", function() {
            const inputQuantidade = document.getElementById("quantidade-item");
            const optionSelecionada = this.options[this.selectedIndex];
            const unidadeMedida = optionSelecionada ? optionSelecionada.getAttribute("data-unidade") : "";
            if(unidadeMedida){
                inputQuantidade.placeholder = "Informe a quantidade em " + unidadeMedida;
            } else {
                inputQuantidade.placeholder = "";
            }
        });
    </script>
    <script type="module" src="../js/adicionarItemNaLista.js"></script>
</body>
</html>
