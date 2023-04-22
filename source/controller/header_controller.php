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

    if (!empty($produto) && $produto !== false && !empty($usuario) && $usuario !== null || $usuario !== false) {
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

if (isset($_GET) && $_GET['action'] == 'bsc-qtde-car') {
  $CarrinhoDao = new CarrinhoDAO;

  try {
    $NumProds = $CarrinhoDao->buscarNumProdutos();

  } catch (Exception $ex) {
    $buscaNumProds = array(
      'ok' => false,
      'mensagem' => $ex->getMessage()
    );
  }

  if (isset($_SESSION) && isset($_SESSION['usuario_email'])) {
    $buscaNumProds = array(
      'ok' => true,
      'mensagem' => 'usuário logado'
    );
  } else {
    $buscaNumProds = array(
      'ok' => false,
      'mensagem' => 'usuário não logado'
    );
  }

  $resultRequire = array(
    'buscaNumProds' => $buscaNumProds
  );

  echo json_encode($resultRequire);

  exit();
}

if (isset($_GET) && $_GET['action'] == 'buscar-prods') {
  $CarrinhoDao = new CarrinhoDAO;

  if (!isset($_SESSION['usuario_email'])) {
    $resultRequire[] = [
      'ok' => false,
      'mensagem' => 'Usuário não logado na sessão'
    ];
    
  } else {

    $usuarioEmail = $_SESSION['usuario_email'];
    $loginDAO = new LoginDAO();

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

    echo json_encode(array(
      $resultRequire, $produtos
    ));
    
  }
  exit();
}