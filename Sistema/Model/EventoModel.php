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
                id, 
                nome,
                descricao, 
                data,
                local,
                quant_participantes,
                id_participantes
            FROM eventos
            INNER JOIN id_participantes ON eventos.selecao_mandante_id = sel_mandante.id
            INNER JOIN selecoes AS sel_visitante ON eventos.selecao_visitante_id = sel_visitante.id
            LEFT JOIN grupos ON eventos.grupo_id = grupos.id
            ORDER BY eventos.data_hora ASC"; // Organiza por data e hora

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>