<?php
// str_replace('\\', '/', dirname(__FILE__, 2)) . 

require_once($_SERVER['DOCUMENT_ROOT'] . '/delivery-slg.com.br/source/dao/produtosDAO.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/delivery-slg.com.br/source/dao/restaurantesDAO.php');

class ProdutosController {

  function BuscarProdutos() {
    $dao = new ProdutoDAO();
    return $dao->BuscarProdutos();
  }

  function BuscarNomeRestaurante(int $id) {
    $dao = new RestaurantesDAO();
    return $dao->BuscarPorId($id);
  }

}