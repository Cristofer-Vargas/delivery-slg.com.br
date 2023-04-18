<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/delivery-slg.com.br/source/classes/produtos.class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/delivery-slg.com.br/source/config/functions.php');

class ProdutoDAO
{

  function BuscarProdutos()
  {
    $conection = ConexaoBD();

    try {
      $stmt = $conection->query('SELECT r.nome as nome_restaurante, p.* FROM `produtos` as p INNER JOIN `restaurantes` 
      as r ON p.id_Restaurante = r.id ORDER BY LOWER(p.categoria) ASC');

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
          $produto->setNomeRestaurante($result->nome_restaurante);
          $arr[] = clone $produto;
        }

        return $arr;
      } else {
        echo "A busca por produtos não trouxe resultados!";
        return FALSE;
      }
    } catch (PDOException $ex) {
      echo "Erro ao buscar produtos no banco de dados: ";
      throw $ex;
      die();
    }
  }

  function BuscarProdutosPorFiltro(string $campo, string $ordem)
  {
    $conection = ConexaoBD();



    try {
      if (!empty($campo) && !empty($ordem) && $campo !== 'id_Restaurante') {
        $stmt = $conection->prepare('SELECT r.nome as nome_restaurante, p.* FROM `produtos` as p INNER JOIN `restaurantes` 
        as r ON p.id_Restaurante = r.id ORDER BY ' . 'LOWER(' . $campo . ') ' . "$ordem");

      } else if ($campo === 'id_Restaurante') {
        $stmt = $conection->prepare('SELECT r.nome as nome_restaurante, p.* FROM `produtos` as p INNER JOIN `restaurantes` 
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
          $produto->setNomeRestaurante($result->nome_restaurante);
          $arr[] = clone $produto;
        }

        return $arr;
      } else {
        echo "A busca por produtos no filtro não trouxe resultados!";
        return FALSE;
      }
    } catch (PDOException $ex) {
      $_SESSION['mensagemError'] = 'Erro ao buscar produtos com filtro';
      $_SESSION['erroSucessOrFail'] = false;
      throw $ex;
      die();
    }
  }

  function BuscarPorNome($busca) {
    $conection = ConexaoBD();

    try {
      $stmt = $conection->prepare("SELECT * FROM produtos WHERE nome LIKE '%" . $busca . "%'");
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
        $_SESSION['mensagemError'] = 'Não foi possível um resultado para: ' . $busca;
        $_SESSION['erroSucessOrFail'] = false;
        return false;
      }

    } catch (PDOException $ex) {
      $_SESSION['mensagemError'] = 'Erro ao tentar encontrar produtos no banco de dados';
      $_SESSION['erroSucessOrFail'] = false;
      throw $ex;
      die();
    }
    
  }

  function BuscarPorId(int $id) {
    $conection = ConexaoBD();

    try {
      $stmt = $conection->prepare('SELECT * FROM produtos WHERE id = :id');
      $stmt->bindValue(':id', $id);
      $stmt->execute();

      if ($stmt->rowCount()) {
        $produto = new Produtos();

        while ($result = $stmt->fetch(PDO::FETCH_OBJ)) {
          $produto->setId($result->id);
          $produto->setNome($result->nome);
          $produto->setDescricao($result->descricao);
          $produto->setImagem($result->imagem);
          $produto->setPreco($result->preco);
          $produto->setCategoria($result->categoria);
          $produto->setId_Restaurante($result->id_Restaurante);

        }

        return $produto;

      }

      return false;
      
    } catch (PDOException $ex) {
      $_SESSION['mensagemError'] = 'Erro ao tentar encontrar produto com id';
      $_SESSION['erroSucessOrFail'] = false;
      throw $ex;
      die();
    }

  }

}
