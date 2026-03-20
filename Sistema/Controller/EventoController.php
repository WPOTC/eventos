<?php
require_once "C:/Turma2/xampp/htdocs/eventos/Sistema/Model/EventoModel.php";
require_once "C:/Turma2/xampp/htdocs/eventos/Sistema/DB/Database.php";

class EventoController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function criarEvento($titulo, $descricao, $data, $local, $quant_participantes) {
        return $this->model->criarEvento($titulo, $descricao, $data, $local, $quant_participantes);
    }

    public function editarEvento($titulo, $descricao, $data, $local, $quant_participantes, $id) {
        return $this->model->editarEvento($titulo, $descricao, $data, $local, $quant_participantes, $id);
    }

    public function deletarEvento($id) {
        return $this->model->deletarEvento($id);
    }

    public function listarEventos() {
        return $this->model->listarEventos();
    }

    public function listarInformacoesEvento($id) {
        return $this->model->listarInformacoesEvento($id);
    }

}

?>