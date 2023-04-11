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
    $restaurante = $dao->BuscarPorId($id);
    if (isset($restaurante) && !empty($restaurante)) {
      return $restaurante->getNome();
    }
    return 'Esse produto não está associado a um restaurante';
  }

  function BuscarProdutosComFiltro(string $preco, $ordem) {
    $dao = new ProdutoDAO();
    $produtoFIltrado = $dao->BuscarProdutosPorFiltro($preco, $ordem);


  }

}