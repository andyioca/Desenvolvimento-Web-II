<?php
interface BoletoDAO {
    public function salvar(Boleto $boleto);
    public function excluir($id);
    public function listarTodos();
    public function buscarPorId($id);
}