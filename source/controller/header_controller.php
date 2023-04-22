<?php
session_start();
require_once('../dao/carrinhoDAO.php');
require_once('../dao/produtosDAO.php');
require_once('../dao/loginDAo.php');
require_once('../config/error_message.php');
require_once('../classes/carrinho.class.php');

if (isset($_GET) && !empty($_GET['adc-car'])) {
  if (!isset($_SESSION['usuario_email'])) {
    $resultRequire[] = [
      'ok' => false,
      'mensagem' => 'Usuário não logado'
    ];
  } else {
    $usuarioEmail = $_SESSION['usuario_email'];

    $resultRequire[] = [
      'ok' => true,
      'mensagem' => 'Usuário logado com sucesso, email: ' . "$usuarioEmail"
    ];


    $idProduto = addslashes(filter_input(INPUT_GET, 'adc-car'));
    $CarrinhoDao = new CarrinhoDAO;
    $loginDAO = new LoginDAO;
    $ProdutoDao = new ProdutoDAO;

    try {
      $produto = $ProdutoDao->BuscarPorId($idProduto);
    } catch (Exception $ex) {
      $resultRequire[] = [
        'ok' => false,
        'mensagem' => $ex->getMessage()
      ];
    }

    try {
      $usuario = $loginDAO->buscaUsuario($usuarioEmail);
    } catch (Exception $ex) {
      $resultRequire[] = [
        'ok' => false,
        'mensagem' => $ex->getMessage()
      ];
    }

    if (!empty($produto) && $produto !== false && (!empty($usuario) && $usuario !== null || $usuario !== false)) {
      try {
        $Carrinho = new Carrinho();
        $Carrinho->setId_Produto($produto->getId());
        $Carrinho->setId_Restaurante($produto->getId_Restaurante());
        $Carrinho->setId_Usuario($usuario->getId());
        $Carrinho->setQuantidade(1);
        // if ($carrinho->getQuantidade() <= 0 || $carrinho->getQuantidade() == null) {
        //   $carrinho->setQuantidade(1);
        // }

        $result = $CarrinhoDao->inserirNoCarrinho($Carrinho);
      } catch (Exception $ex) {
        $resultRequire[] = [
          'ok' => false,
          'mensagem' => $ex->getMessage(),
        ];
      }
    } else {
      $resultRequire[] = [
        'ok' => false,
        'mensagem' => 'Sessão inválida ou produto incompativel / sem restaurante cadastrado',
      ];
    }
  }

  echo json_encode($resultRequire);
  exit();
}

// if (isset($_GET) && $_GET['action'] == 'verifica-sessao') {
// }

if (isset($_GET) && $_GET['action'] == 'bsc-qtde-car') {

  if (!isset($_SESSION['usuario_email'])) {
    $buscaNumProds[] = [
      'ok' => false,
      'mensagem' => 'usuário não logado'
    ];
  } else {
    $usuarioEmail = $_SESSION['usuario_email'];

    $resultRequire[] = [
      'ok' => true,
      'mensagem' => 'Usuário logado com sucesso, email: ' . "$usuarioEmail"
    ];
    $CarrinhoDao = new CarrinhoDAO;

    try {
      $NumProds = $CarrinhoDao->buscarNumProdutos();
    } catch (Exception $ex) {
      $buscaNumProds[] = [
        'ok' => false,
        'mensagem' => $ex->getMessage()
      ];
    }
  }

  echo json_encode($buscaNumProds);
  exit();
}

if (isset($_GET) && $_GET['action'] == 'buscar-prods') {

  if (!isset($_SESSION['usuario_email'])) {
    $resultRequire[] = [
      'ok' => false,
      'mensagem' => 'Usuário não logado na sessão'
    ];
  } else {
    $usuarioEmail = $_SESSION['usuario_email'];

    $resultRequire[] = [
      'ok' => true,
      'mensagem' => 'Usuário logado com sucesso, email: ' . "$usuarioEmail"
    ];

    $loginDAO = new LoginDAO();
    $CarrinhoDao = new CarrinhoDAO;

    try {
      $usuario = $loginDAO->buscaUsuario($usuarioEmail);
      $usuarioId = $usuario->getId();
    } catch (Exception $ex) {
      $resultRequire[] = [
        'ok' => false,
        'mensagem' => 'Busca por usuário mal sucedida'
      ];
    }

    try {
      $produtos = $CarrinhoDao->buscarProdutos($usuarioId);
    } catch (Exception $ex) {
      $resultRequire[] = [
        'ok' => false,
        'mensagem' => 'Busca por produtos mal sucedida'
      ];
    }
  }
  echo json_encode(array(
    $resultRequire, $produtos
  ));
  exit();
}
