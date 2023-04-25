<?php

require_once('../config/Conexao.php');
require_once('../dao/ClienteDao.php');
require_once('../model/Cliente.php');

$cliente = new Cliente();
$clientedao = new ClienteDao();

$dados = filter_input_array(INPUT_POST);


    if(isset($_POST['create'])){
        $cliente->setNome($dados['nome']);
        $cliente->setTelefone($dados['telefone']);
        $cliente->setTelefone_Fixo($dados['telefone_fixo']);

        if($clientedao->create($cliente)){
            echo "<script>
            alert('Cadastrado com sucesso!');
            location.href = '../views/cadastro_ticket/index.php';
            </script>
            ";
        }
    }
    else if(isset($_POST['create2'])){
        $cliente->setNome($dados['nome']);
        $cliente->setTelefone($dados['telefone']);
        $cliente->setTelefone_Fixo($dados['telefone_fixo']);

        if($clientedao->create($cliente)){
            echo "<script>
            alert('Cadastrado com sucesso!');
            location.href = '../views/gestao_clientes_adm/index.php';
            </script>
            ";
        }
    }else if(isset($_POST['alterar'])){
       
    $cliente->setID($dados['id_cliente']);
    $cliente->setNome($dados['nome']);
    $cliente->setTelefone($dados['telefone']);
    $cliente->setTelefone_Fixo($dados['telefone_fixo']);
    
      if($clientedao->alterar($cliente)) {
        echo "<script>
                alert('Cliente Atualizado com Sucesso!!');
                location.href = '../views/gestao_clientes_adm/index.php';
            </script>";
          
      }
    }else if(isset($_POST['excluir'])) {
  
    $cliente->setID($_POST['id_cliente']);

    if($clientedao->excluir($cliente)) {

    echo "<script>
            alert('Cliente Deletado com Sucesso!!');
            location.href = '../views/gestao_clientes_adm/index.php';
        </script>";
    }
    else{
        echo "<script>
            alert('Esse cliente já está atribuído em um Ticket. Para apagá-lo, delete o Ticket em questão.');
            location.href = '../views/gestao_clientes_adm/index.php';
        </script>";
    }
    }
    else{
        header("Location: ../");
    }

?>