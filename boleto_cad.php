<?php
require_once "persistencia/PDOBoletoDAO.php";

$id = isset($_GET['id']) ? $_GET['id'] : null;
$b = null;

if ($id) {
    try {
        $conexao = new PDO("sqlite:persistencia/pessoas.db");
        $boletoDAO = new PDOBoletoDAO($conexao);
        $b = $boletoDAO->buscarPorId($id);
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?= $b ? 'Editar' : 'Cadastrar' ?> Boleto</title>
</head>
<body>
    <?php include "menu.php"; ?>
    <h1><?= $b ? 'Editar' : 'Novo' ?> Boleto</h1>
    
    <form action="boleto_acao.php" method="POST">
        <input type="hidden" name="id" value="<?= $b ? $b->getId() : '' ?>">
        <input type="hidden" name="acao" value="salvar">

        <label>Data de Emissão:</label><br>
        <input type="date" name="data_emissao" value="<?= $b ? $b->getDataEmissao() : date('Y-m-d') ?>" required><br><br>

        <label>Data de Vencimento:</label><br>
        <input type="date" name="data_vencimento" value="<?= $b ? $b->getDataVencimento() : '' ?>" required><br><br>

        <label>Valor (R$):</label><br>
        <input type="number" step="0.01" name="valor" value="<?= $b ? $b->getValor() : '' ?>" required><br><br>

        <label>Data de Pagamento:</label><br>
        <input type="date" name="data_pagamento" value="<?= $b ? $b->getDataPagamento() : '' ?>"><br><br>

        <label>Desconto (R$):</label><br>
        <input type="number" step="0.01" name="desconto" value="<?= $b ? $b->getDesconto() : '0.00' ?>"><br><br>

        <label>Juros (R$):</label><br>
        <input type="number" step="0.01" name="juros" value="<?= $b ? $b->getJuros() : '0.00' ?>"><br><br>

        <label>Multa (R$):</label><br>
        <input type="number" step="0.01" name="multa" value="<?= $b ? $b->getMulta() : '0.00' ?>"><br><br>

        <label>Mora (R$):</label><br>
        <input type="number" step="0.01" name="mora" value="<?= $b ? $b->getMora() : '0.00' ?>"><br><br>

        <label>Valor Pago (R$):</label><br>
        <input type="number" step="0.01" name="valor_pago" value="<?= $b ? $b->getValorPago() : '' ?>"><br><br>

        <button type="submit">Salvar Boleto</button>
        <a href="boleto_index.php"><button type="button">Cancelar</button></a>
    </form>
</body>
</html>