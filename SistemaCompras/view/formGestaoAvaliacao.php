<?php
    session_start();
    if(!isset($_SESSION['usuario'])){
        header('Location: formLogin.php');
        exit();
    }
    $usuario = $_SESSION['usuario'];
    $cracha = $_SESSION['cracha'];
    $nivelAcesso = $_SESSION['nivelAcesso'];

require_once __DIR__ . '/../model/Solicitacao.php';
require_once __DIR__ . '/../model/Itens.php';

$solicitacaoModel = new Solicitacao();
$itensModel = new Itens();

// Process approval or rejection
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["acao"])) {
    $id = $_POST["id"] ?? null;
    $tipo_aprovacao = $_POST["tipo_aprovacao"] ?? 'descontar';
    if ($id) {
        if ($_POST["acao"] == "aprovar") {
            $sol = $solicitacaoModel->getById($id);
            if ($sol) {
                $quantidade = $sol['item']['quantidade'];
                $item_id = $sol['item']['id'];
                
                if ($tipo_aprovacao === 'descontar') {
                    $itensModel->deductStock($item_id, $quantidade);
                } elseif ($tipo_aprovacao === 'parcial') {
                    $estoque_atual = $sol['item']['estoque_atual'];
                    $desconto = min($quantidade, $estoque_atual);
                    $itensModel->deductStock($item_id, $desconto);
                } elseif ($tipo_aprovacao === 'comprar') {
                    // Não desconta do estoque
                }

                $solicitacaoModel->updateStatus($id, 'aprovado');
            }
        } elseif ($_POST["acao"] == "reprovar") {
            $solicitacaoModel->updateStatus($id, 'reprovado');
        }
    }
    header("Location: formGestaoAvaliacao.php");
    exit();
}

$solicitacoes = $solicitacaoModel->listAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Gestão e Avaliação</title>
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
        <div id="gestao-avaliacao" class="screen">
            <h1 class="titulo-view">Gestão e Avaliação de Pedidos</h1>
            
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Data</th>
                        <th>Solicitante</th>
                        <th>Crachá</th>
                        <th>Item</th>
                        <th>Quantidade</th>
                        <th>Turma</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($solicitacoes)) { ?>
                        <tr>
                            <td colspan="9" style="text-align: center;">Nenhuma solicitação registrada no sistema.</td>
                        </tr>
                    <?php } else { ?>
                        <?php foreach ($solicitacoes as $sol) { ?>
                            <tr>
                                <td><?= htmlspecialchars($sol['id']) ?></td>
                                <td><?= htmlspecialchars($sol['data']) ?></td>
                                <td><?= htmlspecialchars($sol['usuario']['nome']) ?></td>
                                <td><?= htmlspecialchars($sol['usuario']['cracha']) ?></td>
                                <td><?= htmlspecialchars($sol['item']['descricao']) ?></td>
                                <td><?= htmlspecialchars($sol['item']['quantidade']) ?> <?= htmlspecialchars($sol['item']['unidadeMedida']) ?></td>
                                <td><?= htmlspecialchars($sol['turma']) ?></td>
                                <td>
                                    <?php 
                                        $badgeClass = 'waiting';
                                        if ($sol['status_db'] === 'aprovado') $badgeClass = 'approved';
                                        if ($sol['status_db'] === 'reprovado') $badgeClass = 'rejected';
                                    ?>
                                    <span class="badge <?= $badgeClass ?>"><?= htmlspecialchars($sol['status']) ?></span>
                                </td>
                                <td>
                                    <?php if ($sol['status_db'] === 'em_espera') { ?>
                                        <div class="btn-group">
                                            <form action="formGestaoAvaliacao.php" method="post" style="display:inline; margin-bottom: 5px;">
                                                <input type="hidden" name="id" value="<?= $sol['id'] ?>">
                                                <input type="hidden" name="acao" value="aprovar">
                                                <select name="tipo_aprovacao" style="padding: 4px; margin-right: 5px; border-radius: 4px; border: 1px solid var(--gray);">
                                                    <option value="descontar">Descontar (Estoque: <?= $sol['item']['estoque_atual'] ?>)</option>
                                                    <option value="comprar">Comprar</option>
                                                    <option value="parcial">Descontar parcial e Comprar o resto</option>
                                                </select>
                                                <button type="submit" class="btn-add" style="padding: 5px 10px;">Aprovar</button>
                                            </form>
                                            <br>
                                            <form action="formGestaoAvaliacao.php" method="post" style="display:inline;">
                                                <input type="hidden" name="id" value="<?= $sol['id'] ?>">
                                                <input type="hidden" name="acao" value="reprovar">
                                                <button type="submit" class="btn-del" style="padding: 5px 10px;">Reprovar</button>
                                            </form>
                                        </div>
                                    <?php } else { ?>
                                        <span style="color: var(--gray); font-size: 0.9em;">Avaliado</span>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>
