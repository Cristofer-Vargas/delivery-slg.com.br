<?php

require_once('../classes/carrinho.class.php');
require_once('../config/functions.php');

class CarrinhoDAO {

  function buscarPorId(int $id) {
    $conection = ConexaoBD();

    try {
      $stmt = $conection->prepare('SELECT * FROM carrinho WHERE id = :id');
      $stmt->bindValue(':id', $id);
      $stmt->execute();

      if ($stmt->rowCount()) {
        $carrinho = new Carrinho();
        $arr = array();

        while ($result = $stmt->fetch(PDO::FETCH_OBJ)) {
          $carrinho->setId($result->id);
          $carrinho->setId_Produto($result->id_Produto);
          $carrinho->setId_Restaurante($result->id_Restaurante);
          $carrinho->setId_Usuario($result->id_Usuario);
          $carrinho->setQuantidade($result->quantidade);

          $arr[] = clone $carrinho;
        }
        return $arr;

      }
      return false;

    } catch (PDOException $ex) {
      return new Exception('Erro ao buscar esse carrinho');
      die();
    }
  }

  function buscarProdutos(int $idUser) {
    $conection = ConexaoBD();

    try {
      $stmt = $conection->prepare('SELECT * FROM carrinho WHERE id_Usuario = :idUser');
      $stmt->bindValue(':idUser', $idUser);
      $stmt->execute();

      if ($stmt->rowCount()) {
        $carrinho = new Carrinho();
        $arr = array();

        while ($result = $stmt->fetch(PDO::FETCH_OBJ)) {
          // $carrinho->setId($result->id);
          // $carrinho->setId_Produto($result->id_Produto);
          // $carrinho->setId_Restaurante($result->id_Restaurante);
          // $carrinho->setId_Usuario($result->id_Usuario);
          // $carrinho->setQuantidade($result->quantidade);

          $arr[] = clone $result;

        }

        return $arr;

      } else {
        throw new Exception(' | Não houve produtos no banco de dados | ');
      }

    } catch (PDOException $ex) {
      throw new Exception(' | Não foi possíver acessar os produtos no banco de dados | ' . $ex);
      die();
    }
  }

  function inserirNoCarrinho(Carrinho $carrinho) {
    $conection = ConexaoBD();
    $conection->beginTransaction();

    if ($carrinho->getQuantidade() == '' || $carrinho->getQuantidade() == null || $carrinho->getQuantidade() == 0) {
      $carrinho->setQuantidade(1);
    }

    try {
      $stmt = $conection->prepare('INSERT INTO carrinho (id_Produto, id_Restaurante, id_Usuario, quantidade)
      VALUES (:idProd, :idRes, :idUsu, :qtde)');
      $stmt->bindValue(':idProd', $carrinho->getId_Produto());
      $stmt->bindValue(':idRes', $carrinho->getId_Restaurante());
      $stmt->bindValue(':idUsu', $carrinho->getId_Usuario());
      $stmt->bindValue(':qtde', $carrinho->getQuantidade());
      $stmt->execute();

      if ($stmt == true) {
        $conection->commit();
        return true;
      } else {
        throw new Exception(' | Não foi possivel inserir no carrinho | ');
      }

    } catch (PDOException $ex) {
      $conection->rollBack();
      return new Exception(' | Erro ao inserir no carrinho | ' . $ex);
      die();
    }
  }

  function buscarNumProdutos() {
    $conection = ConexaoBD();

    try {
      $rs = $conection->query('SELECT * FROM carrinho');
      return $rs->rowCount();

    } catch (PDOException $ex) {
      return new Exception('Erro ao buscar produtos do carrinho');
      die();
    }
  }

}