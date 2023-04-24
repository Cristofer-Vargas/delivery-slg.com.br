<?php
include_once '../classes/usuarios.class.php';
include_once '../dao/loginDAO.php';

session_start();

if (isset($_POST)) {
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $senha = isset($_POST['senha']) ? $_POST['senha'] : null;

    if (!$email || !$senha) {
        $_SESSION['mensagem'] = "O Email/CPF e a senha devem ser preenchidos."; //campos da página login não foram preenchidos
        header("Location:../../pages/login.php");
        die();
    }

    $dao = new loginDAO();
    $login = new Usuarios();
    $login = $dao->buscaUsuario($email);


    if ($login && $senha == $login->getSenha()) {
        $_SESSION['usuario_email'] = $login->getEmail(); //o login foi efetuado com sucesso
        header("Location:../../index.php");
    } else {
        $_SESSION['mensagem'] = "O Email/CPF e/ou senha inseridos estão incorretos."; //campos da página login estão incorretos
        header("Location:../../pages/login.php");
        echo json_encode(array('sucesso' => false, 'mensagem' => "O Email/CPF e/ou senha inseridos estão incorretos"));
    }
}
