<?php

class InscricoesModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function participarEvento($id_participante, $id_evento) {
        if ($this->limitarAUmaInscricao($id_participante, $id_evento)) {
            echo "<script>alert('Você já está inscrito neste evento.');</script>";
            return false; // Já inscrito
            exit;
        }
        $sql = "INSERT INTO inscricoes (id_participante, id_evento) VALUES (:id_participante, :id_evento)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':id_participante' => $id_participante,
            ':id_evento' => $id_evento
        ]);
        exit;
    }

    public function limitarAUmaInscricao($id_participante, $id_evento) {
        $sql = "SELECT COUNT(*) FROM inscricoes WHERE id_participante = :id_participante AND id_evento = :id_evento";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':id_participante' => $id_participante,
            ':id_evento' => $id_evento
        ]);
        return $stmt->fetchColumn() > 0;
        
    }
    public function listarParticipantesPorEvento($id_evento){
        $sql = "SELECT participantes.id AS id_participante, participantes.nome, participantes.email FROM participantes
            JOIN inscricoes on participantes.id = inscricoes.id_participante WHERE inscricoes.id_evento = :id_evento";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([
                    ':id_evento' => $id_evento
                ]);
                return $stmt->fetchAll();
    }

    public function listarEventosPorParticipante($id_participante){
        $sql = "SELECT eventos.id, eventos.titulo, eventos.descricao, eventos.data, eventos.local FROM eventos
            JOIN inscricoes on eventos.id = inscricoes.id_evento WHERE inscricoes.id_participante = :id_participante";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([
                    ':id_participante' => $id_participante
                ]);
                return $stmt->fetchAll();
    }
}

?>