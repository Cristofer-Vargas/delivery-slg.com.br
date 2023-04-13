<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/delivery-slg.com.br/source/dao/produtosDAO.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/delivery-slg.com.br/source/dao/restaurantesDAO.php');

class ProdutosController {

  function BuscarProdutos() {
    $dao = new ProdutoDAO();
    $produtos = $dao->BuscarProdutos();

    if (!empty($produtos) && $produtos !== false) {
      $_SESSION['mensagemError'] = 'Produtos encontrados com sucesso!';
      $_SESSION['erroSucessOrFail'] = true;
      MsgPerssonalizadaDeErro();
      return $produtos;
    } else {
      $_SESSION['mensagemError'] = 'Produtos não encontrados no banco de dados!';
      $_SESSION['erroSucessOrFail'] = false;
      MsgPerssonalizadaDeErro();
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
      $_SESSION['mensagemError'] = 'Busca com filtro foi um sucesso!';
      $_SESSION['erroSucessOrFail'] = true;
      MsgPerssonalizadaDeErro();
      return $produtoFiltrado;
      
    } else {
      $_SESSION['mensagemError'] = 'Não foi possível retornar produtos com esse filtro!';
      $_SESSION['erroSucessOrFail'] = false;
      MsgPerssonalizadaDeErro();
    }


  }

}