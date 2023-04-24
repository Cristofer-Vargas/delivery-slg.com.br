<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/delivery-slg.com.br/source/dao/produtosDAO.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/delivery-slg.com.br/source/dao/restaurantesDAO.php');

if (isset($_GET) && isset($_GET['campo']) && isset($_GET['ordem'])) {
  $campo = addslashes(filter_input(INPUT_GET, 'campo'));
  $ordem = addslashes(filter_input(INPUT_GET, 'ordem'));
  $dao = new ProdutoDAO();
  try {
    $produtoFiltrado = $dao->BuscarProdutosPorFiltro($campo, $ordem);
    $resultRequire['msg'][] = [
      'ok' => true,
      'mensagem' => 'busca com sucesso!',
    ];
    $resultRequire['dados'] = $produtoFiltrado;
  } catch (Exception $ex) {
    $resultRequire['msg'][] = [
      'ok' => false,
      'mensagem' => $ex->getMessage(),
    ];
  }
  echo json_encode($resultRequire);
}

class ProdutosController
{

  function BuscarProdutos()
  {
    $dao = new ProdutoDAO();
    $produtos = $dao->BuscarProdutos();

    if (!empty($produtos) && $produtos !== false) {
      return $produtos;
    }
  }

  function BuscarNomeRestaurante(int $id)
  {
    $dao = new RestaurantesDAO();
    $restaurante = $dao->BuscarPorId($id);
    if (isset($restaurante) && !empty($restaurante)) {
      return $restaurante->getNome();
    }
    return 'Restaurante não encontrado';
  }

  // function BuscarProdutosComFiltro(string $campo, string $ordem) {
  //   $dao = new ProdutoDAO();
  //   $produtoFiltrado = $dao->BuscarProdutosPorFiltro($campo, $ordem);

  //   if(!empty($produtoFiltrado) && $produtoFiltrado !== false) {
  //     return $produtoFiltrado; 
  //   }
  // }

  function BuscarProdutosPorCategoria(string $categoria)
  {
    $dao = new ProdutoDAO();
    $produtos = $dao->BuscarProdutosPorCategoria($categoria);
    if (!empty($produtos) && $produtos !== false) {
      return $produtos;
    }
  }

  function BuscarProdutosPorNome(string $busca)
  {
    $dao = new ProdutoDAO;
    $produtos = $dao->BuscarPorNome($busca);

    if (!empty($produtos) && $produtos !== false) {
      return $produtos;
    }
    return false;
  }
}
