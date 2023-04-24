<?php

class Usuarios
{
  private int $id;
  private string $nome;
  private string $rua;
  private string $numero;
  private string $complemento;
  private string $bairro;
  private string $email;
  private string $telefone;
  private string $cpf;
  private string $senha;
  private string $imagem;

  public function getId(): int
  {
    return $this->id;
  }

  public function setId(int $id)
  {
    $this->id = $id;
  }

  public function getNome(): string
  {
    return $this->nome;
  }

  public function setNome(string $nome)
  {
    $this->nome = $nome;
  }

  public function getRua(): string
  {
    return $this->rua;
  }

  public function setRua(string $rua)
  {
    $this->rua = $rua;
  }

  public function getNumero(): string
  {
    return $this->numero;
  }

  public function setNumero(string $numero)
  {
    $this->numero = $numero;
  }

  public function getComplemento(): string
  {
    return $this->complemento;
  }

  public function setComplemento(string $complemento)
  {
    $this->complemento = $complemento;
  }

  public function getBairro(): string
  {
    return $this->bairro;
  }

  public function setBairro(string $bairro)
  {
    $this->bairro = $bairro;
  }

  public function getEmail(): string
  {
    return $this->email;
  }

  public function setEmail(string $email)
  {
    $this->email = $email;
  }

  public function getTelefone(): string
  {
    return $this->telefone;
  }

  public function setTelefone(string $telefone)
  {
    $this->telefone = $telefone;
  }

  public function getCpf(): string
  {
    return $this->cpf;
  }

  public function setCpf(string $cpf)
  {
    $this->cpf = $cpf;
  }

  public function getSenha(): string
  {
    return $this->senha;
  }

  public function setSenha(string $senha)
  {
    $this->senha = $senha;
  }

  public function getImagem(): string
  {
    return $this->imagem;
  }

  public function setImagem(string $imagem)
  {
    $this->imagem = $imagem;
  }
}
