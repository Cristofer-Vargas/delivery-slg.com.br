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

if (isset($_GET) && !empty($_GET['action']) && $_GET['action'] == 'sair-sessao') {
  session_destroy();
  header('Location:/delivery-slg.com.br/index.php');
}

if (isset($_GET) && !empty($_GET['action']) && $_GET['action'] == 'buscar-prods-usuario') {

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

if (isset($_GET) && !empty($_GET['busca'])) {

  $ProdutoDao = new ProdutoDAO();
  $valorProd = addslashes(filter_input(INPUT_GET, 'busca'));

  try {
    $produtos = $ProdutoDao->BuscarPorNomeEmArray($valorProd);
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
      date_default_timezone_set('America/Sao_Paulo');
      if ($produtos == false) {
        $resultRequire['msg']['carrinho'] = [
          'ok' => false,
          'mensagem' => 'Não possue produtos no carrinho'
        ];
      } else {
        $resultRequire['msg']['carrinho'] = [
          'ok' => true,
          'mensagem' => 'Produtos existentes no carrinho'
        ];

        $dataCompra = new DateTime('now');

        for ($i = 0; $i < sizeof($produtos); $i++) {
          $valores[] = [
            'preco' => $produtos[$i]['produto_Preco'],
            'dataCompra' => $dataCompra->format('Y-m-d H:m:s'),
            'idRestaurante' => $produtos[$i]['id_Restaurante'],
            'quantidade' => $produtos[$i]['quantidade'],
            'idProduto' => $produtos[$i]['id_Produto'],
            'idUsuario' => $produtos[$i]['id_Usuario'],
          ];
        }

        $result = $HistoicoPedidos->adicionar($valores);

        $resultCar = $CarrinhoDao->removerDoCarrinho($usuario->getId());

        if ($resultCar) {
          $resultRequire['msg']['compra'] = [
            'ok' => true,
            'mensagem' => 'Compra finalizada com sucesso'
          ];
        } else {
          $resultRequire['msg']['compra'] = [
            'ok' => false,
            'mensagem' => 'Erro ao finalizar a compra'
          ];

        }
      }
    } catch (Exception $ex) {
      $resultRequire['msg'][] = [
        'ok' => false,
        'mensagem' => 'Não foi possivel finalizar a compra'
      ];
    }
  }
  echo json_encode($resultRequire);
  die();
}

if (isset($_POST) && isset($_POST['id'])) {

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
