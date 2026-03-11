<?php

class ParticipanteModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function cadastrarParticipante($nome, $email, $telefone, $senha) {
        $stmt = $this->pdo->prepare("INSERT INTO participantes (nome, email, telefone, senha) VALUES (:nome, :email, :telefone, :senha)");
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':nome' => $nome,
            ':email' => $email,
            ':telefone' => $telefone,
            ':senha' => $senha
        ]);
        return true;
        
    }

    public function loginParticipante($email, $senha) {
        $sql = "SELECT * FROM participantes WHERE email = :email AND senha = :senha";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
        $stmt->execute();

        $participante = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($participante) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['nome'] = $participante['nome'];
            $_SESSION['email'] = $participante['email'];
            $_SESSION['id'] = $participante['id'];
            return $participante;
        }
        return null;
    }

    public function listarParticipantes() {
        $stmt = $this->pdo->query("SELECT * FROM participantes");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function editarParticipante($nome, $email, $telefone, $senha, $id) {
        $sql = "UPDATE participantes 
                SET nome = ?, email = ?, telefone = ?, senha = ? 
                WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nome, $email, $telefone, $senha, $id]);
    }

    public function deletarParticipante($id) {
        $sql = "DELETE FROM participantes WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function listarEventosInscritos($id_participantes){
        $sql = "SELECT titulo from eventos WHERE id_participantes = ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id_participantes]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>