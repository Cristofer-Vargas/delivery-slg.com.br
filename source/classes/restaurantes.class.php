<?php 

class Restaurantes {
  private int $id;
  private string $nome;
  private string $rua;
  private string $numero;
  private string $complemento;
  private string $bairro;
  private string $email;
  private string $telefone;
  private string $cnpj;
  private string $hora_Funcionamento;
  private string $formas_Pagamento;
  private string $formas_Entrega;
  private string $chave_Pix;
  private string $senha;
  private bool $ativo;
  private string $imagem;

  public function getId(): int {
    return $this->id;
  }

  public function setId(int $id) {
    $this->id = $id;
  }
  
  public function getNome(): string {
    return $this->nome;
  }

  public function setNome(string $nome) {
    $this->nome = $nome;
  }
  
  public function getRua(): string {
    return $this->rua;
  }

  public function setRua(string $rua) {
    $this->rua = $rua;
  }
  
  public function getNumero(): string {
    return $this->numero;
  }

  public function setNumero(string $numero) {
    $this->numero = $numero;
  }
  
  public function getComplemento(): string {
    return $this->complemento;
  }

  public function setComplemento(string $complemento) {
    $this->complemento = $complemento;
  }
  
  public function getBairro(): string {
    return $this->bairro;
  }

  public function setBairro(string $bairro) {
    $this->bairro = $bairro;
  }
  
  public function getEmail(): string {
    return $this->email;
  }

  public function setEmail(string $email) {
    $this->email = $email;
  }
  
  public function getTelefone(): string {
    return $this->telefone;
  }

  public function setTelefone(string $telefone) {
    $this->telefone = $telefone;
  }
  
  public function getCnpj(): string {
    return $this->cnpj;
  }

  public function setCnpj(string $cnpj) {
    $this->cnpj = $cnpj;
  }
  
  public function getHora_Funcionamento(): string {
    return $this->hora_Funcionamento;
  }

  public function setHora_Funcionamento(string $hora_Funcionamento) {
    $this->hora_Funcionamento = $hora_Funcionamento;
  }

  public function getFormas_Pagamento(): string {
    return $this->formas_Pagamento;
  }

  public function setFormas_Pagamento(string $formas_Pagamento) {
    $this->formas_Pagamento = $formas_Pagamento;
  }

  public function getFormas_Entrega(): string {
    return $this->formas_Entrega;
  }

  public function setFormas_Entrega(string $formas_Entrega) {
    $this->formas_Entrega = $formas_Entrega;
  }
  
  public function getChave_Pix(): string {
    return $this->chave_Pix;
  }

  public function setChave_Pix(string $chave_Pix) {
    $this->chave_Pix = $chave_Pix;
  }
  
  public function getSenha(): string {
    return $this->senha;
  }

  public function setSenha(string $senha) {
    $this->senha = $senha;
  }
  
  public function getAtivo(): bool {
    return $this->ativo;
  }

  public function setAtivo(bool $ativo) {
    $this->ativo = $ativo;
  }
  
  public function getImagem(): string {
    return $this->imagem;
  }

  public function setImagem(string $imagem) {
    $this->imagem = $imagem;
  }
  
}