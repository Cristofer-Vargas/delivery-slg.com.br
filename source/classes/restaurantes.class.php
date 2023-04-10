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
  private string $chave_Pix;
  private string $senha;
  private bool $ativo;
  private string $imagem;
  private bool $dinheiro;
  private bool $cartao_Credito;
  private bool $cartao_Debito;
  private bool $pix;
  private bool $retirada_Local;
  private bool $motoboy;

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

  public function getDinheiro(): bool {
    return $this->dinheiro;
  }

  public function setDinheiro(bool $dinheiro) {
    $this->dinheiro = $dinheiro;
  }

  public function getCartao_Credito(): bool {
    return $this->cartao_Credito;
  }

  public function setCartao_Credito(bool $cartao_Credito) {
    $this->cartao_Credito = $cartao_Credito;
  }

  public function getCartao_Debito(): bool {
    return $this->cartao_Debito;
  }

  public function setCartao_Debito(bool $cartao_Debito) {
    $this->cartao_Debito = $cartao_Debito;
  }

  public function getPix(): bool {
    return $this->pix;
  }

  public function setPix(bool $pix) {
    $this->pix = $pix;
  }

  public function getRetirada_Local(): bool {
    return $this->retirada_Local;
  }

  public function setRetirada_Local(bool $retirada_Local) {
    $this->retirada_Local = $retirada_Local;
  }

  public function getMotoboy(): bool {
    return $this->motoboy;
  }

  public function setMotoboy(bool $motoboy) {
    $this->motoboy = $motoboy;
  }

  
}