<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/delivery-slg.com.br/source/dao/produtosDAO.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/delivery-slg.com.br/source/dao/restaurantesDAO.php');

class ProdutosController {

  function BuscarProdutos() {
    $dao = new ProdutoDAO();
    $produtos = $dao->BuscarProdutos();

    if (!empty($produtos) && $produtos !== false) {
      return $produtos;
    }
  }

  function BuscarNomeRestaurante(int $id) {
    $dao = new RestaurantesDAO();
    $restaurante = $dao->BuscarPorId($id);
    if (isset($restaurante) && !empty($restaurante)) {
      return $restaurante->getNome();
    }
    return 'Restaurante não encontrado';
  }

  function BuscarProdutosComFiltro(string $campo, string $ordem) {
    $dao = new ProdutoDAO();
    $produtoFiltrado = $dao->BuscarProdutosPorFiltro($campo, $ordem);

    if(!empty($produtoFiltrado) && $produtoFiltrado !== false) {
      return $produtoFiltrado; 
    }
  }

  function BuscarProdutosPorNome(string $busca) {
    $dao = new ProdutoDAO;
    $produtos = $dao->BuscarPorNome($busca);

    if (!empty($produtos) && $produtos !== false) {
      return $produtos;
    }
    return false;

  }

}