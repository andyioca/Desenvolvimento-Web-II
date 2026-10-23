<?php
class Boleto {
    private $id;
    private $dataVencimento;
    private $dataEmissao;
    private $dataPagamento;
    private $valor;
    private $desconto;
    private $juros;
    private $multa;
    private $mora;
    private $valorPago;

    public function __construct($id = null, $dataVencimento = null, $dataEmissao = null, $valor = null) {
        $this->id = $id;
        $this->dataVencimento = $dataVencimento;
        $this->dataEmissao = $dataEmissao;
        $this->valor = $valor;
    }

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }
    
    public function getDataVencimento() { return $this->dataVencimento; }
    public function setDataVencimento($dataVencimento) { $this->dataVencimento = $dataVencimento; }

    public function getDataEmissao() { return $this->dataEmissao; }
    public function setDataEmissao($dataEmissao) { $this->dataEmissao = $dataEmissao; }

    public function getDataPagamento() { return $this->dataPagamento; }
    public function setDataPagamento($dataPagamento) { $this->dataPagamento = $dataPagamento; }

    public function getValor() { return $this->valor; }
    public function setValor($valor) { $this->valor = $valor; }

    public function getDesconto() { return $this->desconto; }
    public function setDesconto($desconto) { $this->desconto = $desconto; }

    public function getJuros() { return $this->juros; }
    public function setJuros($juros) { $this->juros = $juros; }

    public function getMulta() { return $this->multa; }
    public function setMulta($multa) { $this->multa = $multa; }

    public function getMora() { return $this->mora; }
    public function setMora($mora) { $this->mora = $mora; }

    public function getValorPago() { return $this->valorPago; }
    public function setValorPago($valorPago) { $this->valorPago = $valorPago; }
}