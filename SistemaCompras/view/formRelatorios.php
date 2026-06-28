<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../config/database.php';

$user = $_SESSION['user'] ?? null;
if (!$user) {
    header("Location: ../index.php");
    exit();
}

try {
    $db = Database::getConnection();
    
    // Query 1: Overall summary
    $summaryStmt = $db->query("
        SELECT 
            COUNT(*) as total, 
            SUM(CASE WHEN status='em_espera' THEN 1 ELSE 0 END) as pendentes, 
            SUM(CASE WHEN status='aprovado' THEN 1 ELSE 0 END) as aprovados, 
            SUM(CASE WHEN status='reprovado' THEN 1 ELSE 0 END) as reprovados 
        FROM solicitacoes
    ");
    $summary = $summaryStmt->fetch();
    
    // Query 2: Total approved quantities by item
    $itemsStmt = $db->query("
        SELECT i.nome, SUM(s.quantidade) as total_qtd, i.unidade_medida 
        FROM solicitacoes s 
        JOIN itens i ON s.item_id = i.id 
        WHERE s.status = 'aprovado' 
        GROUP BY i.id, i.nome, i.unidade_medida 
        ORDER BY total_qtd DESC
    ");
    $itemStats = $itemsStmt->fetchAll();
    
    // Query 3: Top requesting users
    $usersStmt = $db->query("
        SELECT u.nome, u.cracha, COUNT(s.id) as total_pedidos 
        FROM solicitacoes s 
        JOIN usuarios u ON s.usuario_id = u.id 
        GROUP BY u.id, u.nome, u.cracha 
        ORDER BY total_pedidos DESC 
        LIMIT 5
    ");
    $userStats = $usersStmt->fetchAll();
    
} catch (Exception $e) {
    $error = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Relatórios</title>
</head>
<body>
    <?php include_once __DIR__ . "/../layout/menu.php"; ?>
    <main>
        <div id="relatorios" class="screen">
            <h1 class="titulo-view">Relatórios e Estatísticas</h1>
            
            <?php if (isset($error)) { ?>
                <p style="color: var(--btnRemove); font-weight: bold;"><?= htmlspecialchars($error) ?></p>
            <?php } else { ?>
                
                <!-- Summary Cards Section -->
                <div style="display: flex; gap: 1.5em; margin-top: 1.5em; margin-bottom: 2em; flex-wrap: wrap;">
                    <div style="flex: 1; min-width: 150px; background: var(--white); padding: 1.25em; border-radius: 6px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); text-align: center;">
                        <h3 style="color: var(--dark); font-size: 0.9em; margin-bottom: 0.5em;">Total de Pedidos</h3>
                        <p style="color: var(--azulSenac); font-size: 2em; font-weight: bold;"><?= (int)$summary['total'] ?></p>
                    </div>
                    <div style="flex: 1; min-width: 150px; background: var(--white); padding: 1.25em; border-radius: 6px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); text-align: center;">
                        <h3 style="color: var(--dark); font-size: 0.9em; margin-bottom: 0.5em;">Pendentes</h3>
                        <p style="color: var(--laranjaClaroSenac); font-size: 2em; font-weight: bold;"><?= (int)$summary['pendentes'] ?></p>
                    </div>
                    <div style="flex: 1; min-width: 150px; background: var(--white); padding: 1.25em; border-radius: 6px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); text-align: center;">
                        <h3 style="color: var(--dark); font-size: 0.9em; margin-bottom: 0.5em;">Aprovados</h3>
                        <p style="color: var(--btnInclude); font-size: 2em; font-weight: bold;"><?= (int)$summary['aprovados'] ?></p>
                    </div>
                    <div style="flex: 1; min-width: 150px; background: var(--white); padding: 1.25em; border-radius: 6px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); text-align: center;">
                        <h3 style="color: var(--dark); font-size: 0.9em; margin-bottom: 0.5em;">Reprovados</h3>
                        <p style="color: var(--btnRemove); font-size: 2em; font-weight: bold;"><?= (int)$summary['reprovados'] ?></p>
                    </div>
                </div>

                <div style="display: flex; gap: 2em; flex-wrap: wrap;">
                    <!-- Table 1: Consumption ranking -->
                    <div style="flex: 1; min-width: 300px;">
                        <h2 style="color: var(--laranjaSenac); font-size: 1.25em; border-bottom: 2px solid var(--gray); padding-bottom: 0.5em; margin-bottom: 0.5em;">Consumo de Itens (Aprovados)</h2>
                        <table>
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Quantidade Consumida</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($itemStats)) { ?>
                                    <tr>
                                        <td colspan="2" style="text-align: center;">Nenhum item consumido ainda.</td>
                                    </tr>
                                <?php } else { ?>
                                    <?php foreach ($itemStats as $stat) { ?>
                                        <tr>
                                            <td><?= htmlspecialchars($stat['nome']) ?></td>
                                            <td><?= htmlspecialchars($stat['total_qtd']) ?> <?= htmlspecialchars($stat['unidade_medida']) ?></td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Table 2: Top users ranking -->
                    <div style="flex: 1; min-width: 300px;">
                        <h2 style="color: var(--laranjaSenac); font-size: 1.25em; border-bottom: 2px solid var(--gray); padding-bottom: 0.5em; margin-bottom: 0.5em;">Top Solicitantes (Geral)</h2>
                        <table>
                            <thead>
                                <tr>
                                    <th>Colaborador</th>
                                    <th>Crachá</th>
                                    <th>Qtd Pedidos</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($userStats)) { ?>
                                    <tr>
                                        <td colspan="3" style="text-align: center;">Nenhuma solicitação registrada.</td>
                                    </tr>
                                <?php } else { ?>
                                    <?php foreach ($userStats as $stat) { ?>
                                        <tr>
                                            <td><?= htmlspecialchars($stat['nome']) ?></td>
                                            <td><?= htmlspecialchars($stat['cracha']) ?></td>
                                            <td><?= (int)$stat['total_pedidos'] ?></td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php } ?>
        </div>
    </main>
</body>
</html>
