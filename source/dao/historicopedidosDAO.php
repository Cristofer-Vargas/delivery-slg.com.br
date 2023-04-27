<?php

require_once('../classes/historico_pedidos.class.php');
require_once('../config/functions.php');
require_once('../classes/carrinho.class.php');

class HistoricoPedidosDAO {

  public function adicionar(array $valores) {
    $connection = ConexaoBD();
    
    try {

      $stmt = $connection->prepare('INSERT INTO historico_pedidos 
      (`preco`, `data_Compra`, `id_Restaurante`, `quantidade`, `id_Produto`, `id_Usuario`) 
      VALUES (`preco`, `dataCompra`, `idRestaurante`, `quantidade`, `idProduto`, `idUsuario`, )');

      foreach ($valores as $row) {
        $stmt->execute($row);
      }

    } catch (PDOException $ex) {
      throw $ex;
      die();
    }

  }

}