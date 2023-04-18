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

  try {
    $produto = $ProdutoDao->BuscarPorId($idProduto);
  } catch (Exception $ex) {
    MsgPerssonalizadaDeErro();
    echo 'Erro ao encontrar o produtos especificado';
  }

  try {
    $usuario = $loginDAO->buscaUsuario($usuarioEmail);

  } catch (Exception $ex) {
    echo 'Erro ao encontrar o usuario na sessão';
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
        echo 'Adicionado com sucesso!';
      } else {
        echo 'Não foi possivel adicionar!';
      }

    } catch (Exception $ex) {
      MsgPerssonalizadaDeErro();
      echo 'Erro ao inserir no carrinho';
    }

  }

  // $Retorno = [
  //   "ErroBuscaProd" => $buscaProd,
  //   "ErroBuscaUser" => $buscaUser,
  //   "ErroInserirNoCar" => $inserirNoCar,
  //   "Operation" => $Operation
  // ];

  // class Erros {
  //   public $buscaProd = $buscaProd;
  //   public $buscaUser = $buscaUser;
  //   public $inserirNoCar = $inserirNoCar;
  // }
  exit();
  }

}