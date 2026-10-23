<?php
require_once 'BoletoDAO.php';
require_once __DIR__ . '/../boleto.php';

class PDOBoletoDAO implements BoletoDAO {
    private $conexao;

    public function __construct($conexao) {
        $this->conexao = $conexao;
    }

    public function salvar(Boleto $boleto) {
        if ($boleto->getId() == null) {
            $sql = "INSERT INTO boleto (data_vencimento, data_emissao, data_pagamento, valor, desconto, juros, multa, mora, valor_pago) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->conexao->prepare($sql);
        } else {
            $sql = "UPDATE boleto SET data_vencimento = ?, data_emissao = ?, data_pagamento = ?, valor = ?, desconto = ?, juros = ?, multa = ?, mora = ?, valor_pago = ? WHERE id = ?";
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(10, $boleto->getId());
        }

        $stmt->bindValue(1, $boleto->getDataVencimento());
        $stmt->bindValue(2, $boleto->getDataEmissao());
        $stmt->bindValue(3, $boleto->getDataPagamento());
        $stmt->bindValue(4, $boleto->getValor());
        $stmt->bindValue(5, $boleto->getDesconto());
        $stmt->bindValue(6, $boleto->getJuros());
        $stmt->bindValue(7, $boleto->getMulta());
        $stmt->bindValue(8, $boleto->getMora());
        $stmt->bindValue(9, $boleto->getValorPago());

        return $stmt->execute();
    }

    public function excluir($id) {
        $sql = "DELETE FROM boleto WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        return $stmt->execute();
    }

    public function listarTodos() {
        $sql = "SELECT * FROM boleto";
        $stmt = $this->conexao->query($sql);
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $boletos = [];

        foreach ($resultados as $row) {
            $b = new Boleto($row['id'], $row['data_vencimento'], $row['data_emissao'], $row['valor']);
            $b->setDataPagamento($row['data_pagamento']);
            $b->setDesconto($row['desconto']);
            $b->setJuros($row['juros']);
            $b->setMulta($row['multa']);
            $b->setMora($row['mora']);
            $b->setValorPago($row['valor_pago']);
            $boletos[] = $b;
        }
        return $boletos;
    }

    public function buscarPorId($id) {
        $sql = "SELECT * FROM boleto WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $b = new Boleto($row['id'], $row['data_vencimento'], $row['data_emissao'], $row['valor']);
            $b->setDataPagamento($row['data_pagamento']);
            $b->setDesconto($row['desconto']);
            $b->setJuros($row['juros']);
            $b->setMulta($row['multa']);
            $b->setMora($row['mora']);
            $b->setValorPago($row['valor_pago']);
            return $b;
        }
        return null;
    }
}