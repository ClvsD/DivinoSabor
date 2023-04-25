<?php

class Funcionario
{

    private $id_funcionario;
    private $nome;
    private $turno;
    private $salario;
    private $tipo;
    private $data_contratacao;
    private $cpf;
    private $email;
    private $telefone;
    private $senha;
    private $cep;
    private $cidade;
    private $bairro;
    private $endereco;
    private $numero_casa;
    private $foto;
    private $numero_vendas;

    function getID(){
        return $this->id_funcionario;
    }

    function getNome(){
        return $this->nome;
    }

    function getTurno(){
        return $this->turno;
    }

    function getSalario(){
        return $this->salario;
    }

    function getTipo(){
        return $this->tipo;
    }

    function getData_Contratacao(){
        return $this->data_contratacao;
    }

    function getCPF(){
        return $this->cpf;
    }

    function getEmail(){
        return $this->email;
    }

    function getTelefone(){
        return $this->telefone;
    }

    function getSenha(){
        return $this->senha;
    }

    function getCEP(){
        return $this->cep;
    }

    function getCidade(){
        return $this->cidade;
    }

    function getBairro(){
        return $this->bairro;
    }

    function getEndereco(){
        return $this->endereco;
    }

    function getNumero_Casa(){
        return $this->numero_casa;
    }

    function getFoto(){
        return $this->foto;
    }

    function getNumero_Vendas(){
        return $this->numero_vendas;
    }

    function setID($id_funcionario){
        return $this->id_funcionario = $id_funcionario;
    }

    function setNome($nome){
        return $this->nome = $nome;
    }

    function setTurno($turno){
        return $this->turno = $turno;
    }

    function setSalario($salario){
        return $this->salario = $salario;
    }

    function setTipo($tipo){
        return $this->tipo = $tipo;
    }

    function setData_Contratacao($data_contratacao){
        return $this->data_contratacao = $data_contratacao;
    }

    function setCPF($cpf){
        return $this->cpf = $cpf;
    }

    function setEmail($email){
        return $this->email = $email;
    }

    function setTelefone($telefone){
        return $this->telefone = $telefone;
    }

    function setSenha($senha){
        return $this->senha = $senha;
    }

    function setCEP($cep){
        return $this->cep = $cep;
    }

    function setCidade($cidade){
        return $this->cidade = $cidade;
    }

    function setBairro($bairro){
        return $this->bairro = $bairro;
    }

    function setEndereco($endereco){
        return $this->endereco = $endereco;
    }

    function setNumero_Casa($numero_casa){
        return $this->numero_casa = $numero_casa;
    }

    function setFoto($foto){
        return $this->foto = $foto;
    }

    function setNumero_Vendas($numero_vendas){
        return $this->numero_vendas = $numero_vendas;
    }

}

?>