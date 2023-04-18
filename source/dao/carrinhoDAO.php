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
      $_SESSION['mensagemError'] = 'Erro ao buscar esse carrinho';
      $_SESSION['erroSucessOrFail'] = false;
      throw $ex;
      die();
    }
  }

  function inserirNoCarrinho(Carrinho $carrinho) {
    $conection = ConexaoBD();
    $conection->beginTransaction();

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
        return false;
      }

    } catch (PDOException $ex) {
      $conection->rollBack();
      $_SESSION['mensagemError'] = 'Erro ao inserir no carrinho';
      $_SESSION['erroSucessOrFail'] = false;
      throw $ex;
      die();
    }
  }

}