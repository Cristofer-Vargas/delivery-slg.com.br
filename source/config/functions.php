<?php
// Funções de verificar sessão, conectar com banco de dados, menssagem de erro perssonalizado, etc

function ConexaoBD()
{
  $HOST = 'localhost';
  $USER = 'root';
  $PASS = '';
  $DBNAME = 'deliveryslg';

  $dns = 'mysql:host=' . $HOST . ';dbname=' . $DBNAME;
  $opcoes = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8',
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
  );

  try {
    $conexao = new PDO($dns, $USER, $PASS, $opcoes);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conexao;

  } catch (PDOException $ex) {
    echo 'Erro ao conectar ao banco: ' . $ex->getMessage();
  }
}

function validaSessao() {
  if (!isset($_SESSION) || !isset($_SESSION['usuario_email']) || !$_SESSION['id_usuario']) {
    header("Location: ../pages/login.php");
  }
}