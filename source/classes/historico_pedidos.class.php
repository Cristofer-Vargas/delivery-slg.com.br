<?php

class Historico_Pedidos {
  private int $id;
  private int $id_Restaurante;
  private int $id_Produto;
  private int $id_Usuario;
  private float $preco;
  private string $data_Compra;
  private int $quantidade;
  private string $status;

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

  public function getPreco(): float {
    return $this->preco;
  }

  public function setPreco(float $preco) {
    $this->preco = $preco;
  }

  public function getData_Compra(): string {
    return $this->data_Compra;
  }

  public function setData_Compra(string $data_Compra) {
    $this->data_Compra = $data_Compra;
  }

  public function getQuantidade(): int {
    return $this->quantidade;
  }

  public function setQuantidade(int $quantidade) {
    $this->quantidade = $quantidade;
  }

  public function getStatus(): string {
    return $this->status;
  }

  public function setStatus(string $status) {
    $this->status = $status;
  }
}