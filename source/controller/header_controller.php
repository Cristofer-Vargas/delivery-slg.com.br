<?php
session_start();
require_once('../dao/carrinhoDAO.php');
require_once('../dao/produtosDAO.php');
require_once('../dao/restaurantesDAO.php');
require_once('../dao/loginDAo.php');
require_once('../dao/historicopedidosDAO.php');
require_once('../config/error_message.php');
require_once('../classes/carrinho.class.php');

if (isset($_GET) && !empty($_GET['adc-car'])) {
  if (!isset($_SESSION['usuario_email'])) {
    $resultRequire['msg']['login'] = [
      'ok' => false,
      'mensagem' => 'Usuário não logado'
    ];
  } else {
    $usuarioEmail = $_SESSION['usuario_email'];

    $resultRequire['msg']['login'] = [
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
      $resultRequire['msg'][] = [
        'ok' => false,
        'mensagem' => $ex->getMessage()
      ];
    }

    try {
      $usuario = $loginDAO->buscaUsuario($usuarioEmail);
    } catch (Exception $ex) {
      $resultRequire['msg'][] = [
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
        $resultRequire['msg'][] = [
          'ok' => false,
          'mensagem' => $ex->getMessage(),
        ];
      }
    } else {
      $resultRequire['msg'][] = [
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

if (isset($_GET) &&  !empty($_GET['action']) && $_GET['action'] == 'buscar-prods-usuario') {

  if (!isset($_SESSION['usuario_email'])) {
    $resultRequire['msg']['login'] = [
      'ok' => false,
      'mensagem' => 'Usuário não logado na sessão'
    ];
  } else {
    $usuarioEmail = $_SESSION['usuario_email'];

    $resultRequire['msg']['login'] = [
      'ok' => true,
      'mensagem' => 'Usuário logado com sucesso, email: ' . "$usuarioEmail"
    ];

    $loginDAO = new LoginDAO();
    $CarrinhoDao = new CarrinhoDAO();

    try {
      $usuario = $loginDAO->buscaUsuario($usuarioEmail);
      $usuarioId = $usuario->getId();
    } catch (Exception $ex) {
      $resultRequire['msg'][] = [
        'ok' => false,
        'mensagem' => 'Busca por usuário mal sucedida'
      ];
    }

    try {
      $produtos = $CarrinhoDao->buscarProdutos($usuarioId);
      if ($produtos == false) {
        $resultRequire['dados'] = false;
      } else {
        $resultRequire['dados'] = $produtos;
      }
    } catch (Exception $ex) {
      $resultRequire['msg'][] = [
        'ok' => false,
        'mensagem' => 'Busca por produtos mal sucedida'
      ];
    }
  }
  echo json_encode($resultRequire);
  exit();
}

if (isset($_GET) && !empty($_GET['action']) && $_GET['action'] == 'finalizar-compra') {
  
  if (!isset($_SESSION['usuario_email'])) {
    $resultRequire['msg']['login'] = [
      'ok' => false,
      'mensagem' => 'Usuário não logado na sessão'
    ];
  } else {
    $usuarioEmail = $_SESSION['usuario_email'];

    $resultRequire['msg']['login'] = [
      'ok' => true,
      'mensagem' => 'Usuário logado com sucesso, email: ' . "$usuarioEmail"
    ];

    $loginDAO = new LoginDAO();
    $CarrinhoDao = new CarrinhoDAO();
    $HistoicoPedidos = new HistoricoPedidosDAO();

    try {
      $usuario = $loginDAO->buscaUsuario($usuarioEmail);
    } catch (Exception $ex) {
      $resultRequire['msg'][] = [
        'ok' => false,
        'mensagem' => 'Não foi possivel achar usuário da sessão'
      ];
    }

    try {
      $produtos = $CarrinhoDao->buscarProdutos($usuario->getId());
    } catch (Exception $ex) {
      $resultRequire['msg'][] = [
        'ok' => false,
        'mensagem' => 'Não foi possivel retornar produtos'
      ];
    }

    try {
      $result = $HistoicoPedidos->adicionar($produtos);
    } catch(Exception $ex) {
      $resultRequire['msg'][] = [
        'ok' => false,
        'mensagem' => 'Não foi possivel finalizar a compra'
      ];
    }

  }

}

if (isset($_POST) && isset($_POST['id'])){

  if (!isset($_SESSION['usuario_email'])) {
    $resultRequire['msg']['login'] = [
      'ok' => false,
      'mensagem' => 'Usuário não logado na sessão'
    ];

  } else {
    $usuarioEmail = $_SESSION['usuario_email'];
    $idProdCar = addslashes(filter_input(INPUT_POST, 'id'));

    $resultRequire['msg']['login'] = [
      'ok' => true,
      'mensagem' => 'Usuário logado com sucesso, email: ' . "$usuarioEmail"
    ];

    $loginDAO = new LoginDAO();
    $CarrinhoDao = new CarrinhoDAO();

    try {
      $usuario = $loginDAO->buscaUsuario($usuarioEmail);
      $usuarioID = $usuario->getId();
    } catch (Exception $ex) {
      $resultRequire['msg'][] = [
        'ok' => false,
        'mensagem' => 'Usuário não encontrado'
      ];
    }

    try {
      $result = $CarrinhoDao->excluirDoCarrinho($usuarioID, $idProdCar);
      $resultRequire['msg']['validacao'] = [
        'ok' => true,
        'mensagem' => 'Produto Excluido com sucesso'
      ];
    } catch (Exception $ex) {
      $resultRequire['msg'][] = [
        'ok' => false,
        'mensagem' => 'Não foi possível exluir esse item do carrinho'
      ];
    }

    echo json_encode($resultRequire);

  }

}