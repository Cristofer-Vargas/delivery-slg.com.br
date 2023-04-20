<?php

include_once '../classes/usuarios.class.php';
include_once '../dao/loginDAO.php';

session_start();

if (isset($_POST)) {
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $senha = isset($_POST['senha']) ? $_POST['senha'] : null;

    if (!$email || !$senha) {
        echo json_encode(array('sucesso' => false, 'mensagem' => "O Email/CPF e a senha devem ser preenchidos.")); //erro:campos da página alterarsenha não foram preenchidos
        die();
    }

    $dao = new loginDAO();
    $login = new Usuarios();
    $login = $dao->buscaUsuario($email);
    if (!isset($login) || empty($login) || empty($login->getId())) {
        echo json_encode(array('sucesso' => false, 'mensagem' => "O Email/CPF e/ou senha inseridos estão incorretos.")); //erro:campos da página alterasenha estão incorretos
        die();
    }

    if ($senha == $login->getSenha()) {
        echo json_encode(array('sucesso' => false, 'mensagem' => "A nova senha não pode ser igual a senha atual.")); //erro:a senha inserida é a senha atual
        die();
    }

    $login->setSenha($senha);

    $modal = $dao->alteraSenha($login);

    if ($modal) {
        echo json_encode(array('sucesso' => true, 'mensagem' => "A senha foi alterada com sucesso.")); //sucesso ao alterar a senha 
    } else {
        echo json_encode(array('sucesso' => false, 'mensagem' => "Erro ao alterar a senha.")); //erro ao alterar a senha
    }
}
