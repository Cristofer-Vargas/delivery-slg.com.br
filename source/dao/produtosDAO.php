<?php

require_once('/delivery-slg.com.br/source/classes/produtos.class.php');
require_once('/delivery-slg.com.br/source/config/functions.php');

class ProdutoDAO {

  function BuscarProdutos() {
    $conection = ConexaoBD();

    try {
      $stmt = $conection->query('SELECT * FROM produtos');

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

    } catch (PDOException $ex) {
      echo "Erro ao buscar produtos no banco de dados: " . $ex->getMessage();
      die();
    }
  }

}