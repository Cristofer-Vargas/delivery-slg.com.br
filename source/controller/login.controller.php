<<<<<<< HEAD
<?php
include_once '../classes/usuarios.class.php';
include_once '../dao/loginDAO.php';

session_start();

if (isset($_POST)) {
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $senha = isset($_POST['senha']) ? $_POST['senha'] : null;

    if (!$email || !$senha) {
        $_SESSION['mensagem'] = "O Email/CPF e a senha devem ser preenchidos.";
        header("Location:../../pages/login.php");
        //preencher campos
        return 0;
    }

    $dao = new loginDAO();
    $login = new Usuarios();
    $login = $dao->buscaUsuario($email);
    if (!isset($login) || empty($login) || empty($login->getId())) {
        $_SESSION['mensagem'] = "O Email/CPF e/ou senha inseridos estão incorretos.";
        header("Location:../../pages/login.php");
        echo json_encode(array('sucesso' => false, 'mensagem' => "O Email/CPF inseridos estão incorretos"));
        die();
    }

    $login->setSenha($senha);

    if ($login && $senha == $login->getSenha()) {
        //login sucesso
        $_SESSION['usuario_email'] = $login->getEmail();
        header("Location:../../index.php");
    } else {
        $_SESSION['mensagem'] = "O Email/CPF e/ou senha inseridos estão incorretos.";
        header("Location:../../pages/login.php");
        //echo json_encode(array('sucesso' => false, 'mensagem' => "O Email/CPF e/ou senha inseridos estão incorretos"));
    }
}
=======
<?php
include_once '../classes/usuarios.class.php';
include_once '../dao/loginDAO.php';

session_start();

if (isset($_POST)) {
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $senha = isset($_POST['senha']) ? $_POST['senha'] : null;

    if (!$email || !$senha) {
        $_SESSION['mensagem'] = "O Email/CPF e a senha devem ser preenchidos.";
        header("Location:../../pages/login.php");
        //preencher campos
        return 0;
    }

    $dao = new loginDAO();
    $login = new Usuarios();
    $login = $dao->buscaUsuario($email);
    if (!isset($login) || empty($login) || empty($login->getId())) {
        $_SESSION['mensagem'] = "O Email/CPF e/ou senha inseridos estão incorretos.";
        header("Location:../../pages/login.php");
        echo json_encode(array('sucesso' => false, 'mensagem' => "O Email/CPF e/ou senha inseridos estão incorretos"));
        die();
    }

    $login->setSenha($senha);

    if ($login && $senha == $login->getSenha()) {
        //login sucesso
        $_SESSION['usuario_email'] = $login->getEmail();
        header("Location:../../index.php");
    } else {
        $_SESSION['mensagem'] = "O Email/CPF e/ou senha inseridos estão incorretos.";
        header("Location:../../pages/login.php");
        //echo json_encode(array('sucesso' => false, 'mensagem' => "O Email/CPF e/ou senha inseridos estão incorretos"));
    }
}
>>>>>>> 54f9ab128a38ebd5db61e9789cfde5ac7c48bff0
