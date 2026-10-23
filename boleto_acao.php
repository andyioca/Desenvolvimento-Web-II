<?php
require_once "persistencia/PDOBoletoDAO.php";

$acao = isset($_POST['acao']) ? $_POST['acao'] : (isset($_GET['acao']) ? $_GET['acao'] : '');

try {
    $conexao = new PDO("sqlite:persistencia/pessoas.db");
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $boletoDAO = new PDOBoletoDAO($conexao);

    if ($acao == 'salvar') {
        $id = !empty($_POST['id']) ? $_POST['id'] : null;
        
        $b = new Boleto(
            $id,
            $_POST['data_vencimento'],
            $_POST['data_emissao'],
            $_POST['valor']
        );
        
        $b->setDataPagamento(!empty($_POST['data_pagamento']) ? $_POST['data_pagamento'] : null);
        $b->setDesconto(!empty($_POST['desconto']) ? $_POST['desconto'] : 0);
        $b->setJuros(!empty($_POST['juros']) ? $_POST['juros'] : 0);
        $b->setMulta(!empty($_POST['multa']) ? $_POST['multa'] : 0);
        $b->setMora(!empty($_POST['mora']) ? $_POST['mora'] : 0);
        $b->setValorPago(!empty($_POST['valor_pago']) ? $_POST['valor_pago'] : null);

        $boletoDAO->salvar($b);
    } 
    
    if ($acao == 'excluir') {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if ($id) {
            $boletoDAO->excluir($id);
        }
    }

    header("Location: boleto_index.php");
    exit;

} catch (PDOException $e) {
    echo "Erro ao processar a ação: " . $e->getMessage();
}