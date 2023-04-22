<?php
include_once '../classes/restaurantes.class.php';
include_once '../dao/loginDAO.php';
include_once '../dao/restaurantesDAO.php';

session_start();

if (isset($_POST)) {
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $senha = isset($_POST['senha']) ? $_POST['senha'] : null;

    if (!$email || !$senha) {
        $_SESSION['mensagem'] = "O Email/CNPJ e a senha devem ser preenchidos."; //campos da página login não foram preenchidos
        header("Location:../../pages/loginempresa.php");
        return 0;
    }

    $dao = new restaurantesDAO();
    $restaurante = new Restaurantes();
    $restaurante = $dao->buscaRestaurante($email);

    if ($restaurante && $senha == $restaurante->getSenha()) {
        $_SESSION['usuario_email'] = $restaurante->getEmail(); //o login foi efetuado com sucesso
        header("Location:../../index.php");
    } else {
        $_SESSION['mensagem'] = "O Email/CNPJ e/ou senha inseridos estão incorretos."; //campos da página login estão incorretos
        header("Location:../../pages/loginempresa.php");
        echo json_encode(array('sucesso' => false, 'mensagem' => "O Email/CNPJ e/ou senha inseridos estão incorretos"));
    }
}
