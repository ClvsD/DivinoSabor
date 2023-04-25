<?php

class Conexao {

    protected static $conexao;

    private function __construct() {
        $db_host = "localhost";
        $db_nome = "divino_sabor"; 
        $db_usuario = "root";
        $db_senha = "";
        $db_driver = "mysql";

        try{
            self::$conexao = new PDO("$db_driver:host=$db_host; dbname=$db_nome", $db_usuario, $db_senha);
            self::$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$conexao->exec('SET NAMES utf8');

            //echo "Conexão bem sucedida";
        }
        catch(PDOException $e){
            //echo "Conexão falhou";
        }
    }

    public static function getConexao(){
        if(!self::$conexao){
            new Conexao();
        }
        return self::$conexao;
    }
}
?>
