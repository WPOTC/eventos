
<?php
require_once "C:/Turma2/xampp/htdocs/eventos/Sistema/Model/InscricoesModel.php";
require_once "C:/Turma2/xampp/htdocs/eventos/Sistema/DB/Database.php";

class InscricoesController {
    private $inscricoesModel;

    public function __construct($inscricoesModel) {
        $this->inscricoesModel = $inscricoesModel;
    }

    public function participarEvento($id_participante, $id_evento) {
        return $this->inscricoesModel->participarEvento($id_participante, $id_evento);
    }

    public function listarParticipantesPorEvento($id_evento) {
        return $this->inscricoesModel->listarParticipantesPorEvento($id_evento);
    }
    public function listarEventosPorParticipante($id_participante) {
        return $this->inscricoesModel->listarEventosPorParticipante($id_participante);
    }
}
