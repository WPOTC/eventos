<?php

require_once "C:/Turma2/xampp/htdocs/eventos/Sistema/Model/ParticipanteModel.php";
require_once "C:/Turma2/xampp/htdocs/eventos/Sistema/DB/Database.php";

class ParticipanteController{
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function cadastrarParticipante($nome, $email, $telefone, $senha) {
        return $this->model->cadastrarParticipante($nome, $email, $telefone, $senha);
    }

    public function loginParticipante($email, $senha) {
        return $this->model->loginParticipante($email, $senha);
    }

    public function listarInformacoesParticipante($id) {
        return $this->model->listarInformacoesParticipante($id);
    }

    public function editarParticipante($nome, $email, $telefone, $senha, $id) {
        return $this->model->editarParticipante($nome, $email, $telefone, $senha, $id);
    }

    public function deletarParticipante($id) {
        return $this->model->deletarParticipante($id);
    }

    public function listarParticipante($id) {
        return $this->model->listarInformacoesParticipante($id);
    }
}

?>