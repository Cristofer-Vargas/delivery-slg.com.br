<?php

require_once('../classes/carrinho.class.php');
require_once('../config/functions.php');

class carrinhoDAO {

  function inserirNoCarrinho(Carrinho $carrinho) {
    $conection = ConexaoBD();

    $conection->prepare('INSERT INTO carrinho (id_Produto, id_Restaurante) VALUES ()');
  }

}