<?php

class Ticket
{

    private $id_ticket;
    private $data_criacao;
    private $data_entrega;
    private $valor_final;
    private $status;
    private $id_funcionario;
    private $id_cliente;
    private $nome_cliente;
    private $nome_funcionario;
    private $nome_pacote;
    private $observacao;
    private $cidade;
    private $bairro;
    private $endereco;
    private $numero_casa;
    private $celularCliente;
    private $telefoneCliente;

    function getID(){
        return $this->id_ticket;
    }

    function getDataCriacao(){
        return $this->data_criacao;
    }

    function getDataEntrega(){
        return $this->data_entrega;
    }

    function getValor_Final(){
        return $this->valor_final;
    }

    function getStatus(){
        return $this->status;
    }

    function getID_Funcionario(){
        return $this->id_funcionario;
    }

    function getID_Cliente(){
        return $this->id_cliente;
    }

    function getNome_Cliente(){
        return $this->nome_cliente;
    }

    function getNome_Funcionario(){
        return $this->nome_funcionario;
    }

    function getNome_Pacote(){
        return $this->nome_pacote;
    }

    function getObservacao(){
        return $this->observacao;
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

    function getCelularCliente(){
        return $this->celularCliente;
    }

    function getTelefoneCliente(){
        return $this->telefoneCliente;
    }

    function setID($id_ticket){
        return $this->id_ticket = $id_ticket;
    }

    function setDataCriacao($data_criacao){
        return $this->data_criacao = $data_criacao;
    }

    function setDataEntrega($data_entrega){
        return $this->data_entrega = $data_entrega;
    }

    function setValor_Final($valor_final){
        return $this->valor_final = $valor_final;
    }

    function setStatus($status){
        return $this->status = $status;
    }

    function setID_Funcionario($id_funcionario){
        return $this->id_funcionario = $id_funcionario;
    }

    function setID_Cliente($id_cliente){
        return $this->id_cliente = $id_cliente;
    }

    function setNomeCliente($nome_cliente){
        return $this->nome_cliente = $nome_cliente;
    }

    function setNomeFuncionario($nome_funcionario){
        return $this->nome_funcionario = $nome_funcionario;
    }

    function setNome_Pacote($nome_pacote){
        return $this->nome_pacote = $nome_pacote;
    }

    function setObservacao($observacao){
        return $this->observacao = $observacao;
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

    function setCelularCliente($celularCliente){
        return $this->celularCliente = $celularCliente;
    }

    function setTelefoneCliente($telefoneCliente){
        return $this->telefoneCliente = $telefoneCliente;
    }

}

?>