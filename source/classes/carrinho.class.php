<?php

class Carrinho {
  private int $id;
  private int $id_Restaurante;
  private int $id_Produto;
  private int $id_Usuario;
  private int $quantidade;

  public function getId(): int {
    return $this->id;
  }

  public function setId(int $id) {
    $this->id = $id;
  }

  public function getId_Restaurante(): int {
    return $this->id_Restaurante;
  }

  public function setId_Restaurante(int $id_Restaurante) {
    $this->id_Restaurante = $id_Restaurante;
  }

  public function getId_Produto(): int {
    return $this->id_Produto;
  }

  public function setId_Produto(int $id_Produto) {
    $this->id_Produto = $id_Produto;
  }

  public function getId_Usuario(): int {
    return $this->id_Usuario;
  }

  public function setId_Usuario(int $id_Usuario) {
    $this->id_Usuario = $id_Usuario;
  }

  public function getQuantidade(): int {
    return $this->quantidade;
  }

  public function setQuantidade(int $quantidade) {
    $this->quantidade = $quantidade;
  }
}