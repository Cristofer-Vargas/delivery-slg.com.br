<?php

class Carrinho {
  private int $id;
  private int $id_Restaurante;
  private string $nome_Restaurante;
  private string $produto_Imagem;
  private string $produto_Nome;
  private string $produto_Preco;
  private int $id_Produto;
  private int $id_Usuario;
  private int $quantidade;

  public function toArray() {
    return [
      'id' => $this->id,
      'id_Restaurante' => $this->id_Restaurante,
      'nome_Restaurante' => $this->nome_Restaurante,
      'produto_Imagem' => $this->produto_Imagem,
      'produto_Nome' => $this->produto_Nome,
      'produto_Preco' => $this->produto_Preco,
      'id_Produto' => $this->id_Produto,
      'id_Usuario' => $this->id_Usuario,
      'quantidade' => $this->quantidade
    ];
  }

  public function getNome_Restaurante(): string {
    return $this->nome_Restaurante;
  }

  public function setNome_Restaurante(string $nome_Restaurante) {
    $this->nome_Restaurante = $nome_Restaurante;
  }
  
  public function getProduto_Imagem(): string {
    return $this->produto_Imagem;
  }

  public function setProduto_Imagem(string $produto_Imagem) {
    $this->produto_Imagem = $produto_Imagem;
  }
  
  public function getProduto_Nome(): string {
    return $this->produto_Nome;
  }

  public function setProduto_Nome(string $produto_Nome) {
    $this->produto_Nome = $produto_Nome;
  }
  
  public function getProduto_Preco(): string {
    return $this->produto_Preco;
  }

  public function setProduto_Preco(string $produto_Preco) {
    $this->produto_Preco = $produto_Preco;
  }
  
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