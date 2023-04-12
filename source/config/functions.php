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

function MsgPerssonalizadaDeErro() {
  if (isset($_SESSION) && isset($_SESSION['mensagemError']) && $_SESSION['erroSucessOrFail'] == false) {
    ?>

      <div class="notification notification-error">
        <div class="notification-title notification-title-error">
          <i class="fa-solid fa-circle-xmark"></i>
          <span>A operação falhou!</span>
        </div>  
        <div class="notification-mesage">
          <?= $_SESSION['mensagemError'] ?> </br>
        </div>
      </div>

    <?php
  }
  
  if (isset($_SESSION) && isset($_SESSION['mensagemError']) && $_SESSION['erroSucessOrFail'] == true) {
    ?>

      <div class="notification notification-sucess">
        <div class="notification-title notification-title-sucess">
          <i class="fa-solid fa-circle-check"></i>
          <span>Sucesso!</span>
        </div>
        <div class="notification-mesage">
          <?= $_SESSION['mensagemError'] ?> </br>
        </div>
      </div>

    <?php
  }

  unset($_SESSION['mensagemError'], $_SESSION['erroSucessOrFail']);
}