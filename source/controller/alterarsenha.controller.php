<?php

include_once '../classes/usuarios.class.php';
include_once '../dao/loginDAO.php';

session_start();

if (isset($_POST)) {
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $senha = isset($_POST['senha']) ? $_POST['senha'] : null;

    if (!$email || !$senha) {
        echo json_encode(array('sucesso' => false, 'mensagem' => "O Email/CPF e a senha devem ser preenchidos."));
        header("Location:../../pages/login.php");
        //preencher campos
        return 0;
    }

    $dao = new loginDAO();
    $login = new Usuarios();
    $login = $dao->buscaUsuario($email);
    if (!isset($login) || empty($login) || empty($login->getId())) {
        echo json_encode(array('sucesso' => false, 'mensagem' => "O Email/CPF e/ou senha inseridos estão incorretos"));
        die();
    }

    $login->setSenha($senha);

    $modal = $dao->alteraSenha($login);

    if ($login && $senha == $login->getSenha()) {
        //login sucesso
        echo json_encode(array('sucesso' => true, 'mensagem' => "O Email/CPF e/ou senha inseridos estão incorretos"));
    } else {
        echo json_encode(array('sucesso' => false, 'mensagem' => "O Email/CPF e/ou senha inseridos estão incorretos"));
    }
}
