<?php

class Cliente
{
    
    private $id_cliente;
    private $nome;
    private $telefone;
    private $telefone_fixo;
    private $total_pedidos;

    function getID(){
        return $this->id_cliente;
    }

    function getNome(){
        return $this->nome;
    }

    function getTelefone(){
        return $this->telefone;
    }

    function getTelefone_Fixo(){
        return $this->telefone_fixo;
    }

    function getTotal_Pedidos(){
        return $this->total_pedidos;
    }

    function setID($id_cliente){
        return $this->id_cliente = $id_cliente;
    }

    function setNome($nome){
        return $this->nome = $nome;
    }

    function setTelefone($telefone){
        return $this->telefone = $telefone;
    }

    function setTelefone_Fixo($telefone_fixo){
        return $this->telefone_fixo = $telefone_fixo;
    }

    function setTotal_Pedidos($total_pedidos){
        return $this->total_pedidos = $total_pedidos;
    }   

}
?>