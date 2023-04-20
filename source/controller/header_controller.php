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
      'mensagem' => 'Usuário não logado na sessão'
    ];
    
  } else {
    $resultRequire[] = [
      'ok' => true,
      'mensagem' => 'Usuário logado na sessão'
    ];

    $usuarioEmail = $_SESSION['usuario_email'];

    $idProduto = addslashes(filter_input(INPUT_GET, 'adc-car'));
    $CarrinhoDao = new CarrinhoDAO;
    $loginDAO = new LoginDAO;
    $ProdutoDao = new ProdutoDAO;

    try {
      $produto = $ProdutoDao->BuscarPorId($idProduto);
      $resultRequire[] = [
        'ok' => true,
        'mensagem' => 'Produto encontrado'
      ];

    } catch (Exception $ex) {
      $resultRequire[] = [
        'ok' => false,
        'mensagem' => $ex->getMessage()
      ];
    }

    try {
      $usuario = $loginDAO->buscaUsuario($usuarioEmail);
      $resultRequire[] = [
        'ok' => true,
        'mensagem' => 'Usuario da sessão encontrada'
      ];

    } catch (Exception $ex) {
      $resultRequire[] = [
        'ok' => true,
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

        $result = $CarrinhoDao->inserirNoCarrinho($Carrinho);
        $resultRequire[] = [
          'ok' => true,
          'mensagem' => 'inserido no carrinho com sucesso',
        ];
        
      } catch (Exception $ex) {
        $resultRequire[] = [
          'ok' => false,
          'mensagem' => $ex->getMessage(),
        ];
      }
      $resultRequire[] = [
        'ok' => true,
        'mensagem' => 'Sessão válida e produtos compátiveis / com restaurante cadastrado',
      ];
    } else {
      $resultRequire[] = [
        'ok' => false,
        'mensagem' => 'Sessão inválida ou produto incompativel / sem restaurante cadastrado',
      ];
    }

    // $resultRequire = array(
    //   'User' => $user,
    //   'buscaProd' => $buscaProd,
    //   'buscaUser' => $buscaUser,
    //   'insertCar' => $insertCar,
    //   'RequirementosParaInserir' => $RequirementosParaInserir
    // );
    echo json_encode($resultRequire);

  }
  exit();
}

if (isset($_GET) && $_GET['action'] == 'bsc-qtde-car') {
  $CarrinhoDao = new CarrinhoDAO;

  try {
    $NumProds = $CarrinhoDao->buscarNumProdutos();
    $buscaNumProds = array(
      'ok' => true, 
      'dados' => $NumProds
    );

  } catch (Exception $ex) {
    $buscaNumProds = array(
      'ok' => false,
      'mensagem' => $ex->getMessage()
    );
  }

  $resultRequire = array(
    'buscaNumProds' => $buscaNumProds
  );

  echo json_encode($resultRequire);

  exit();
}
?>