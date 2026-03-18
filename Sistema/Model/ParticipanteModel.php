<?php

class ParticipanteModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

     public function verificarEmailExistente($email) {
        $sql = "SELECT COUNT(*) FROM participantes WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    public function cadastrarParticipante($nome, $email, $telefone, $senha) {
        if ($this->verificarEmailExistente($email)) {
            return false; // Já existe o email
        }

        $sql = "INSERT INTO participantes (nome, email, telefone, senha) 
                VALUES (:nome, :email, :telefone, :senha)";
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
            $_SESSION['participante_id'] = $participante['id'];
            $_SESSION['nome'] = $participante['nome'];
            $_SESSION['email'] = $participante['email'];
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

    public function listarInformacoesParticipante($id) {
        $sql = "SELECT * FROM participantes WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function participarDeEvento($id_participantes, $id_eventos){
        // Recebe também o id do evento
        // Exemplo: participarDeEvento($id_participantes, $id_eventos)
        // Atualiza o participante para vincular ao evento
        // (Se quiser permitir múltiplos eventos por participante, é necessário uma tabela de associação)
        // Aqui, cada participante só pode participar de um evento
        $sql = "UPDATE participantes SET id_eventos = :id_eventos WHERE id = :id_participantes";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':id_eventos' => $id_eventos,
            ':id_participantes' => $id_participantes
        ]);
    }

    public function listarEventosInscritos($id_participantes){
        $sql = "SELECT titulo from eventos WHERE id_participantes = ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id_participantes]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>