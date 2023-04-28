<?php

require_once('../classes/historico_pedidos.class.php');
require_once('../config/functions.php');
require_once('../classes/carrinho.class.php');

class HistoricoPedidosDAO
{

  public function adicionar(array $valores)
  {
    $connection = ConexaoBD();

    try {

      $stmt = $connection->prepare('INSERT INTO historico_pedidos 
      (`preco`, `data_Compra`, `id_Restaurante`, `quantidade`, `id_Produto`, `id_Usuario`) 
      VALUES (?, ?, ?, ?, ?, ?)');

      foreach ($valores as $data) {


        // var_dump($keys);
        // foreach ($data as $sla) {
          // $stmt->execute($sla);
          // echo $sla . "<br>";
          // $stmt->bindValue(":preco", $sla);
          // $stmt->bindValue(":dataCompra", $sla);
          // $stmt->bindValue(":idRestaurante", $sla);
          // $stmt->bindValue(":quantidade", $sla);
          // $stmt->bindValue(":idProduto", $sla);
          // $stmt->bindValue(":idUsuario", $sla);
        // }
        $keys = array_keys($data);
        
        for ($i = 0; $i < count($keys); $i++) {
          $stmt->bindValue($i + 1, $data[$keys[$i]]);
        }
        $stmt->execute();
      }
    } catch (PDOException $ex) {
      echo $ex->getMessage();
      // throw $ex;
      die();
    }
  }
}
