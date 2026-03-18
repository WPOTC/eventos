<?php

class EventoModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function criarEvento($titulo, $descricao, $data, $local, $quant_participantes) {
        $sql = "INSERT INTO eventos (titulo, descricao, data, local) VALUES (:titulo, :descricao, :data, :local)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':titulo' => $titulo,
            ':descricao' => $descricao,
            ':data' => $data,
            ':local' => $local
        ]);
    }

    public function editarEvento($titulo, $descricao, $data, $local, $quant_participantes, $id) {
        $sql = "UPDATE eventos 
                SET titulo = ?, descricao = ?, data = ?, local = ?, quant_participantes = ? 
                WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$titulo, $descricao, $data, $local, $quant_participantes, $id]);
    }
    public function deletarEvento($id) {
        $sql = "DELETE FROM eventos WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function listarEventos()
    {
        $sql = "SELECT 
                    eventos.id, 
                    eventos.titulo,
                    eventos.descricao, 
                    eventos.data, 
                    eventos.local,
                    eventos.quant_participantes,
                    eventos.id_participantes,
                    (
                        SELECT COUNT(*) FROM participantes WHERE participantes.id_eventos = eventos.id
                    ) AS vagas_ocupadas,
                    participantes.nome AS nome_participante
                FROM eventos
                LEFT JOIN participantes ON eventos.id_participantes = participantes.id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>