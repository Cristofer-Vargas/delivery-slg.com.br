<?php
include_once '../config/functions.php';
include_once '../classes/usuarios.class.php';

class LoginDAO
{
    public function buscaUsuario(string $email)
    {
        $pdo = ConexaoBD();
        try {
            $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ? OR cpf = ?");
            $stmt->bindValue(1, $email);
            $stmt->bindValue(2, $email);
            $stmt->execute();
            if ($stmt->rowCount()) {
                $obj = new Usuarios();
                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $obj->setId($rs->id);
                    $obj->setEmail($rs->email);
                    $obj->setCpf($rs->cpf);
                    $obj->setSenha($rs->senha);

                    $result = clone $obj;
                }
                return $result;
            } else {
                return NULL;
            }
        } catch (PDOException $ex) {
            echo "Erro: " + $ex->getMessage();
            die();
        }
    }

    public function alteraSenha(Usuarios $usuarios)
    {
        $pdo = ConexaoBD();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare("UPDATE usuarios SET senha = :senha WHERE id = :id");
            $stmt->bindValue(":senha", $usuarios->getSenha());
            $stmt->bindValue(":id", $usuarios->getId());
            $stmt->execute();
            if ($stmt->rowCount()) {
                $pdo->commit();
                return TRUE;
            }
            return FALSE;
        } catch (PDOException $ex) {
            echo "Erro ao atualizar senha: " . $ex->getMessage();
            $pdo->rollBack();
            die();
        }
    }
}
