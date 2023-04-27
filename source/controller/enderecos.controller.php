<?php

require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "../dao/enderecosDAO.php");
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "../classes/enderecos.class.php");


class EnderecosController
{
    public function buscarEnderecos($id_usuario)
    {
        $dao = new enderecosDAO();
        return $dao->buscarEnderecos($id_usuario);
    }
    public function cadastraEndereco(Enderecos $enderecos)
    {
        $dao = new enderecosDAO();
        return $dao->cadastraEndereco($enderecos);
    }

    public function atualizarEndereco(Enderecos $enderecos)
    {
        $dao = new enderecosDAO();
        return $dao->atualizaEndereco($enderecos);
    }

    public function excluirEndereco($id_usuario)
    {
        $dao = new enderecosDAO();
        return $dao->removeEndereco($id_usuario);
    }
    public function buscarPorId($id)
    {
        $dao = new enderecosDAO();
        return $dao->buscarPorId($id);
    }
}

if (isset($_GET) && isset($_GET['acao']) && $_GET['acao'] == 'salvar') {
    session_start();
    if (isset($_POST)) {
        if (empty($_POST['id'])) {
            $enderecos = new Enderecos();
            $enderecos->setRua(strval(filter_input(INPUT_POST, 'rua')));
            $enderecos->setNumero(strval(filter_input(INPUT_POST, 'numero')));
            $enderecos->setComplemento(strval(filter_input(INPUT_POST, 'complemento')));
            $enderecos->setBairro(strval(filter_input(INPUT_POST, 'bairro')));
            $enderecos->setId_Usuario(intval(filter_input(INPUT_POST, 'id_usuario')));


            $dao = new enderecosDAO();
            $result = $dao->cadastraEndereco($enderecos);
            if ($result == true) {
                $_SESSION['sucesso'] = true;
                $_SESSION['mensagem'] = "Endereço cadastrado com sucesso!";
                header("Location:../../pages/enderecos.php");
            } else {
                $_SESSION['sucesso'] = false;
                $_SESSION['mensagem'] = "Erro ao cadastrar endereço.";
                header("Location:../../pages/enderecos.php");
            }
        } else {
            $enderecos = new Enderecos();
            $enderecos->setRua(strval(filter_input(INPUT_POST, 'rua')));
            $enderecos->setNumero(strval(filter_input(INPUT_POST, 'numero')));
            $enderecos->setComplemento(strval(filter_input(INPUT_POST, 'complemento')));
            $enderecos->setBairro(strval(filter_input(INPUT_POST, 'bairro')));
            $enderecos->setId_Usuario(intval(filter_input(INPUT_POST, 'id_usuario')));
            $enderecos->setId(intval(filter_input(INPUT_POST, "id")));


            $dao = new enderecosDAO();
            $result = $dao->atualizaEndereco($enderecos);
            if ($result == true) {
                $_SESSION['sucesso'] = true;
                $_SESSION['mensagem'] = "Endereço atualizado com sucesso!";
                header("Location:../../pages/enderecos.php");
            } else {
                $_SESSION['sucesso'] = false;
                $_SESSION['mensagem'] = "Erro ao atualizar endereço.";
                header("Location:../../pages/enderecos.php");
            }
        }
    }
}
