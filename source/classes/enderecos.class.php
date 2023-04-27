<?php

class Enderecos
{
    private int $id = 0;
    private int $id_Usuario = 0;
    private string $rua = "";
    private string $numero = "";
    private string $complemento = "";
    private string $bairro = "";

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getId_Usuario(): int
    {
        return $this->id_Usuario;
    }

    public function setId_Usuario(int $id)
    {
        $this->id_Usuario = $id;
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
}
