<?php
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '../config/functions.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '../classes/usuarios.class.php');

class CadastroUsuarioDAO
{

    public function Inserir(Usuarios $usuarios)
    {
        $pdo = ConexaoBD();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha, cpf, telefone) VALUES (:nome, :email, :senha, :cpf, :tel)");
            $stmt->bindValue(":nome", $usuarios->getNome());
            $stmt->bindValue(":email", $usuarios->getEmail());
            $stmt->bindValue(":senha", $usuarios->getSenha());
            $stmt->bindValue(":cpf", $usuarios->getCpf());
            $stmt->bindValue(":tel", $usuarios->getTelefone());
            $stmt->execute();
            if ($stmt->rowCount()) {
                $pdo->commit();
                return TRUE;
            }
            return FALSE;
        } catch (PDOException $ex) {
            echo "Erro ao cadastrar usuário: " . $ex->getMessage();
            $pdo->rollBack();
            die();
        }
    }
}
