<?php

class EventoModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function criarEvento($titulo, $descricao, $data, $local, $quant_participantes) {
        $sql = "INSERT INTO eventos (titulo, descricao, data, local, quant_participantes) VALUES (:titulo, :descricao, :data, :local, :quant_participantes)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':titulo' => $titulo,
            ':descricao' => $descricao,
            ':data' => $data,
            ':local' => $local,
            ':quant_participantes' => $quant_participantes
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
        // Exclui inscrições relacionadas ao evento primeiro
        $sql = "DELETE FROM inscricoes WHERE id_evento = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);

        // Agora exclui o evento
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
                    COUNT(inscricoes.id_participante) AS vagas_ocupadas
                FROM eventos
                LEFT JOIN inscricoes ON eventos.id = inscricoes.id_evento
                GROUP BY eventos.id";


        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        // var_dump($stmt->fetchAll(PDO::FETCH_ASSOC));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarInformacoesEvento($id) {
        $sql = "SELECT * FROM eventos WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

?>