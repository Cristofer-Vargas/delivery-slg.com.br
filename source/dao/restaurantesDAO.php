<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/delivery-slg.com.br/source/classes/restaurantes.class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/delivery-slg.com.br/source/config/functions.php');

class RestaurantesDAO {

  function BuscarPorId(int $id) {
    $conection = ConexaoBD();

    try {
      $stmt = $conection->prepare('SELECT * FROM restaurantes WHERE id = :id');
      $stmt->bindValue(':id', $id);
      $stmt->execute();

      if ($stmt->rowCount()) {
        $restaurante = new Restaurantes();

        while ($result = $stmt->fetch(PDO::FETCH_OBJ)) {
          $restaurante->setId($result->id);
          $restaurante->setNome($result->nome);
          $restaurante->setRua($result->rua);
          $restaurante->setNumero($result->numero);
          $restaurante->setComplemento($result->complemento);
          $restaurante->setBairro($result->bairro);
          $restaurante->setEmail($result->email);
          $restaurante->setTelefone($result->telefone);
          $restaurante->setCnpj($result->cnpj);
          $restaurante->setHora_Funcionamento($result->hora_Funcionamento);
          $restaurante->setFormas_Pagamento($result->formas_De_Pagamento);
          $restaurante->setFormas_Entrega($result->forma_De_Entrega);
          $restaurante->setChave_Pix($result->chave_Pix);
          $restaurante->setSenha($result->senha);
          $restaurante->setAtivo($result->ativo);
          $restaurante->setImagem($result->imagem);
        }
        return $restaurante;

      } else {
        echo "Não foi possivel achar restaurante!";
        return FALSE;
      }

    } catch (PDOException $ex) {
      echo "Erro em encontrar esse restaurante";
      die();
    }
  }

}