<?php
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "../dao/cadastrousuarioDAO.php");
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "../classes/usuarios.class.php");

class cadUsuarioController
{
    public function cadastrarUsuario(Usuarios $usuarios)
    {
        $dao = new CadastroUsuarioDAO();
        return $dao->Inserir($usuarios);
    }
}
