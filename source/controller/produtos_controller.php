<?php

require_once('/delivery-slg.com.br/source/dao/produtosDAO.php');

class ProdutosController {

  function BuscarProdutos() {
    $dao = new ProdutoDAO();
    return $dao->BuscarProdutos();
  }

}