<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/delivery-slg.com.br/source/classes/produtos.class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/delivery-slg.com.br/source/config/functions.php');

class ProdutoDAO {

  function BuscarProdutos() {
    $conection = ConexaoBD();

    try {
      $stmt = $conection->query('SELECT * FROM produtos ORDER BY categoria ASC');

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
      echo "Erro ao buscar produtos no banco de dados: ";
      die();
    }
  }

  function BuscarProdutosPorFiltro(string $campo, string $ordem) {
    $conection = ConexaoBD();

    try {
      if (!empty($campo) && !empty($ordem)) {
        $stmt = $conection->prepare('SELECT * FROM produtos ORDER BY ' . "$campo " . "$ordem");

      } else if ($campo === 'id_Restaurante') {
        $stmt = $conection->prepare('SELECT p.* FROM `produtos` as p INNER JOIN `restaurantes` 
        as r ON p.id_Restaurante = r.id ORDER BY r.nome ' . $ordem);

      } else {
        echo "Compos incorretos para a filtragem de dados";
        $stmt = $conection->prepare("SELECT * FROM produtos ORDER BY categoria ASC");
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
      $_SESSION['mensagemError'] = 'Erro ao buscar produtos com esse filtro no banco de dados:';
      $_SESSION['erroSucessOrFail'] = false;
      die();
    }
  }

}