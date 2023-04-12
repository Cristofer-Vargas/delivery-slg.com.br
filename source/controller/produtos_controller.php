<?php
// str_replace('\\', '/', dirname(__FILE__, 2)) . 

require_once($_SERVER['DOCUMENT_ROOT'] . '/delivery-slg.com.br/source/dao/produtosDAO.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/delivery-slg.com.br/source/dao/restaurantesDAO.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/delivery-slg.com.br/source/config/functions.php');

class ProdutosController {

  function BuscarProdutos() {
    $dao = new ProdutoDAO();
    return $dao->BuscarProdutos();
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

    if(!empty($produtoFiltrado)) {
      return $produtoFiltrado;
    } else {
      return 'Não foi possível retornar produtos com esse filtro';
    }


  }

}