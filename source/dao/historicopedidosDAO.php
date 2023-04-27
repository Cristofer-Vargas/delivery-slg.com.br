<?php

require_once('../classes/historico_pedidos.class.php');
require_once('../config/functions.php');
require_once('../classes/carrinho.class.php');

class HistoricoPedidosDAO {

  public function adicionar(array $produtos) {
    $connection = ConexaoBD();
    
    try {

      $stmt = $connection->prepare('INSERT INTO historico_pedidos 
      (`id`, `preco`, `data_Compra`, `id_Restaurante`, `quantidade`, `id_Produto`, `id_Usuario`, `status`) 
      VALUES ()');

    } catch (PDOException $ex) {
      throw $ex;
      die();
    }

  }

}