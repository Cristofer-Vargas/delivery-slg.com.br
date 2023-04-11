<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/delivery-slg.com.br/source/classes/produtos.class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/delivery-slg.com.br/source/config/functions.php');

class ProdutoDAO {

  function BuscarProdutos() {
    $conection = ConexaoBD();

    try {
      $stmt = $conection->query('SELECT * FROM produtos ORDER BY id_Restaurante');

      if ($stmt->rowCount()) {
        $produto = new Produtos();
        $arr = array();
        while ($result = $stmt->fetch(PDO::FETCH_OBJ)) {
          $produto->setId($result->id);
          $produto->setNome($result->nome);
          $produto->setDescricao($result->descricao);
          $produto->setImagem($result->imagem);
          $produto->setPreco($result->preco);
          $produto->setCategoria($result->categoria);
          $produto->setId_Restaurante($result->id_Restaurante);
          $arr[] = clone $produto;
        }

        return $arr;
      } else {
        echo "A busca por produtos não trouxe resultados!";
        return FALSE;
      }

    } catch (PDOException $ex) {
      echo "Erro ao buscar produtos no banco de dados: " . $ex->getMessage();
      die();
    }
  }

  // Varios parametros para varios "regras" que serão inseridas no sql
  // function BuscarProdutosPorFiltro(string $sql_filtro) {
  function BuscarProdutosPorFiltro(string $campo, $ordem) {
    $conection = ConexaoBD();

    try {
      $sql = "";
      if (!empty($campo) && !empty($ordem)) {
        $sql = "SELECT * FROM produtos ORDER BY :campo :ordem";
        $stmt = $conection->prepare($sql);
        $stmt->bindValue(":campo", $campo);
      } else {
        $sql = "SELECT * FROM produtos ORDER BY nome desc";
        $stmt = $conection->prepare($sql);
      }

      $stmt->execute();
      if ($stmt->rowCount()) {
        $produto = new Produtos();
        $arr = array();
        while ($result = $stmt->fetch(PDO::FETCH_OBJ)) {
          $produto->setId($result->id);
          $produto->setNome($result->nome);
          $produto->setDescricao($result->descricao);
          $produto->setImagem($result->imagem);
          $produto->setPreco($result->preco);
          $produto->setCategoria($result->categoria);
          $produto->setId_Restaurante($result->id_Restaurante);
          $arr[] = clone $produto;
        }

        return $arr;
      } else {
        echo "A busca por produtos no filtro não trouxe resultados!";
        return FALSE;
      }

    } catch (PDOException $ex) {
      echo "Erro ao buscar produtos com esse filtro no banco de dados: " . $ex->getMessage();
      die();
    }
  }

}