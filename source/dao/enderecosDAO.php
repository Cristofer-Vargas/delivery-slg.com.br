<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/delivery-slg.com.br/source/config/functions.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/delivery-slg.com.br/source/classes/enderecos.class.php');

class enderecosDAO
{

    public function cadastraEndereco(Enderecos $enderecos)
    {
        $pdo = ConexaoBD();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare("INSERT INTO enderecos (rua, numero, complemento, bairro, id_usuario) VALUES (:rua, :numero, :complemento, :bairro, :id_usuario)");
            $stmt->bindValue(":rua", $enderecos->getRua());
            $stmt->bindValue(":numero", $enderecos->getNumero());
            $stmt->bindValue(":complemento", $enderecos->getComplemento());
            $stmt->bindValue(":bairro", $enderecos->getBairro());
            $stmt->bindValue(":id_usuario", $enderecos->getId_Usuario());
            $stmt->execute();
            if ($stmt->rowCount()) {
                $pdo->commit();
                return TRUE;
            }
            return FALSE;
        } catch (PDOException $ex) {
            echo "Erro ao cadastrar endereço: " . $ex->getMessage();
            $pdo->rollBack();
            die();
        }
    }

    public function buscarEnderecos($id_usuario)
    {
        $pdo = ConexaoBD();
        try {
            $stmt = $pdo->prepare("SELECT * FROM enderecos WHERE id_usuario = :id_usuario;");
            $stmt->bindValue(":id_usuario", $id_usuario);
            $stmt->execute();
            $enderecos = new Enderecos();
            $retorno = array();
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                $enderecos->setId_Usuario($rs->id_usuario);
                $enderecos->setRua(($rs->rua));
                $enderecos->setNumero($rs->numero);
                $enderecos->setComplemento($rs->complemento);
                $enderecos->setBairro($rs->bairro);
                $enderecos->setId($rs->id);
                $retorno[] = clone $enderecos;
            }
            return $retorno;
        } catch (PDOException $ex) {
            echo "Erro ao buscar endereço: " . $ex->getMessage();
            die();
        }
    }

    public function buscarPorId($id)
    {
        $pdo = ConexaoBD();
        try {
            $stmt = $pdo->prepare("SELECT * FROM enderecos WHERE id = :id;");
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            $endereco = new Enderecos();
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                $endereco->setId_Usuario($rs->id_usuario);
                $endereco->setRua(($rs->rua));
                $endereco->setNumero($rs->numero);
                $endereco->setComplemento($rs->complemento);
                $endereco->setBairro($rs->bairro);
                $endereco->setId($rs->id);
            }
            return $endereco;
        } catch (PDOException $ex) {
            echo "Erro ao buscar endereço: " . $ex->getMessage();
            die();
        }
    }

    public function atualizaEndereco(Enderecos $enderecos)
    {
        $pdo = ConexaoBD();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare("UPDATE enderecos SET rua = :rua, numero = :numero, complemento = :complemento, bairro = :bairro WHERE id = :id");
            $stmt->bindValue(":rua", $enderecos->getRua());
            $stmt->bindValue(":numero", $enderecos->getNumero());
            $stmt->bindValue(":complemento", $enderecos->getComplemento());
            $stmt->bindValue(":bairro", $enderecos->getBairro());
            $stmt->bindValue(":id", $enderecos->getId());

            $stmt->execute();
            if ($stmt->rowCount()) {
                $pdo->commit();
                return TRUE;
            }
            return FALSE;
        } catch (PDOException $ex) {
            $pdo->rollBack();
            echo "Erro ao atualizar endereço: " . $ex->getMessage();
            die();
        }
    }

    public function removeEndereco($id)
    {
        $pdo = ConexaoBD();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare('DELETE FROM enderecos WHERE id= :id');
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            if ($stmt->rowCount()) {
                $pdo->commit();
            }
            return $stmt->rowCount();
        } catch (PDOException $ex) {
            echo "Erro ao excluir endereço: " . $ex->getMessage();
            $pdo->rollBack();
            die();
        }
    }
}
