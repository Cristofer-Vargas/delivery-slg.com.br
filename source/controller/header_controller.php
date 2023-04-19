<?php
session_start();
require_once('../dao/carrinhoDAO.php');
require_once('../dao/produtosDAO.php');
require_once('../dao/loginDAo.php');
require_once('../config/error_message.php');
require_once('../classes/carrinho.class.php');

if (isset($_GET) && !empty($_GET['adc-car'])) {
  if (!isset($_SESSION['usuario_email'])) {
    echo 'Usuário não logado na sessão!';
  } else {

    $usuarioEmail = $_SESSION['usuario_email'];

    $idProduto = addslashes(filter_input(INPUT_GET, 'adc-car'));
    $CarrinhoDao = new CarrinhoDAO;
    $loginDAO = new LoginDAO;
    $ProdutoDao = new ProdutoDAO;
    $OperationReqst = array();

    try {
      $produto = $ProdutoDao->BuscarPorId($idProduto);
      $OperationReqst['buscaProduto'] = true;
    } catch (Exception $ex) {
      // MsgPerssonalizadaDeErro();
      $OperationReqst['buscaProduto'] = false;
    }

    try {
      $usuario = $loginDAO->buscaUsuario($usuarioEmail);
      $OperationReqst['buscaUsuario'] = true;
    } catch (Exception $ex) {
      $OperationReqst['buscaUsuario'] = false;
    }

    if (!empty($produto) && $produto !== false && !empty($usuario) && $usuario !== null || $usuario !== false) {
      try {
        $Carrinho = new Carrinho();
        $Carrinho->setId_Produto($produto->getId());
        $Carrinho->setId_Restaurante($produto->getId_Restaurante());
        $Carrinho->setId_Usuario($usuario->getId());
        $Carrinho->setQuantidade(1);

        $result = $CarrinhoDao->inserirNoCarrinho($Carrinho);

        if ($result == true) {
          $OperationReqst['inserirCarrinho'] = true;
          // echo 'Adicionado com sucesso!';
        //   echo json_encode(array(
        //   'sucesso' => false, 
        //   'mensagem' => ""
        // ));
        } else {
          $OperationReqst['inserirCarrinho'] = false;
          // echo 'Não foi possivel adicionar!';
        }
      } catch (Exception $ex) {
        echo $ex->getMessage();
        // MsgPerssonalizadaDeErro();
      }
    } else {
      $OperationReqst['sessao'] = false;
      // echo 'Sessão inválida ou produto incompativel / sem restaurante cadastrado';
    }

  }
  $resultsReqst = array(
    'buscaUsuario' => $OperationReqst['buscaUsuario'],
    'buscaProduto' => $OperationReqst['buscaProduto'], 
    'inserirCarrinho' => $OperationReqst['inserirCarrinho']
  );
  // var_dump($resultsReqst);
  json_encode($resultsReqst);
  exit();
}

if (isset($_GET) && $_GET['bsc-qtde-car']) {

}
?>