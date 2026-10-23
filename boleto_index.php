<?php
require_once "persistencia/PDOBoletoDAO.php";

try {
  
    $conexao = new PDO("sqlite:persistencia/pessoas.db");
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
   
    $conexao->exec("CREATE TABLE IF NOT EXISTS boleto (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        data_vencimento TEXT NOT NULL,
        data_emissao TEXT NOT NULL,
        data_pagamento TEXT,
        valor REAL NOT NULL,
        desconto REAL DEFAULT 0,
        juros REAL DEFAULT 0,
        multa REAL DEFAULT 0,
        mora REAL DEFAULT 0,
        valor_pago REAL
    );");

  
    $boletoDAO = new PDOBoletoDAO($conexao);
    $boletos = $boletoDAO->listarTodos();
} catch (PDOException $e) {
    echo "Erro na conexão ou na criação da tabela: " . $e->getMessage();
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Listagem de Boletos</title>
</head>
<body>
    <?php include "menu.php"; ?>
    <h1>Gerenciamento de Boletos</h1>
    
    <a href="boleto_cad.php"><button>Novo Boleto</button></a>
    <br><br>
    
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Emissão</th>
                <th>Vencimento</th>
                <th>Valor</th>
                <th>Pagamento</th>
                <th>Valor Pago</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($boletos) == 0): ?>
                <tr>
                    <td colspan="7" style="text-align: center;">Nenhum boleto cadastrado.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($boletos as $b): ?>
                    <tr>
                        <td><?= $b->getId() ?></td>
                        <td><?= date('d/m/Y', strtotime($b->getDataEmissao())) ?></td>
                        <td><?= date('d/m/Y', strtotime($b->getDataVencimento())) ?></td>
                        <td>R$ <?= number_format($b->getValor(), 2, ',', '.') ?></td>
                        <td><?= $b->getDataPagamento() ? date('d/m/Y', strtotime($b->getDataPagamento())) : '-' ?></td>
                        <td><?= $b->getValorPago() ? 'R$ ' . number_format($b->getValorPago(), 2, ',', '.') : '-' ?></td>
                        <td>
                            <a href="boleto_cad.php?id=<?= $b->getId() ?>">Editar</a> | 
                            <a href="boleto_acao.php?acao=excluir&id=<?= $b->getId() ?>" onclick="return confirm('Deseja realmente excluir este boleto?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>