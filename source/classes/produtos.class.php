<?php

class Produtos {
  private int $id;
  private int $id_Restaurante;
  private string $nome;
  private string $descricao;
  private string $imagem;
  private float $preco;
  private string $categoria;

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
  
  public function getNome(): string {
    return $this->nome;
  }

  public function setNome(string $nome) {
    $this->nome = $nome;
  }
  
  public function getDescricao(): string {
    return $this->descricao;
  }

  public function setDescricao(string $descricao) {
    $this->descricao = $descricao;
  }
  
  public function getImagem(): string {
    return $this->imagem;
  }

  public function setImagem(string $imagem) {
    $this->imagem = $imagem;
  }
  
  public function getPreco(): float {
    return $this->preco;
  }

  public function setPreco(float $preco) {
    $this->preco = $preco;
  }
  
  public function getCategoria(): string {
    return $this->categoria;
  }

  public function setCategoria(string $categoria) {
    $this->categoria = $categoria;
  }
}