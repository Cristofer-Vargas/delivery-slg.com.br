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
      $stmt = $conection->prepare(
        'SELECT DISTINCT 
        r.nome as nome_restaurante, 
        p.imagem as produto_imagem, 
        p.nome as produto_nome,
        p.preco as produto_preco, 
        c.* FROM carrinho as c 
        INNER JOIN restaurantes as r 
        INNER JOIN produtos as p 
        ON r.id = c.id_Restaurante 
        AND r.id = p.id_Restaurante 
        WHERE c.id_Usuario = ' . $idUser . '
        GROUP BY c.id');
      $stmt->execute();
      if ($stmt->rowCount()) {
        // var_dump($stmt);
        $carrinho = new Carrinho();

        while ($result = $stmt->fetch(PDO::FETCH_OBJ)) {
          $carrinho->setId($result->id);
          $carrinho->setId_Produto($result->id_Produto);
          $carrinho->setId_Restaurante($result->id_Restaurante);
          $carrinho->setNome_Restaurante($result->nome_restaurante);
          $carrinho->setProduto_Imagem($result->produto_imagem);
          $carrinho->setProduto_Nome($result->produto_nome);
          $carrinho->setProduto_Preco($result->produto_preco);
          $carrinho->setId_Usuario($result->id_Usuario);
          $carrinho->setQuantidade($result->quantidade);

          $arr[] = $carrinho->toArray();
        }

        return $arr;

      } else {
        return false;
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