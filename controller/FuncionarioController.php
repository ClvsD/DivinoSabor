<?php

require_once('../config/Conexao.php');
require_once('../dao/FuncionarioDao.php');
require_once('../model/Funcionario.php');

$funcionario = new Funcionario();
$funcionariodao = new FuncionarioDao();

$dados = filter_input_array(INPUT_POST);

if(isset($_POST['login'])){

    $funcionario->setCPF(strip_tags($dados['cpf']));
    $funcionario->setSenha(strip_tags($dados['senha']));

    $funcionariodao->login($funcionario);
    
    if($funcionariodao->login($funcionario)){
        echo "<script>
                location.href='../';
                </script>";
    }
    else {
        echo "<script>
                location.href='../views/login';
                </script>";
    }
    
}else if(isset($_GET['logout'])){
    $funcionariodao->logout();
    header("Location: ../");

}else if(isset($_POST['cadastrar'])){

        $funcionario->setNome($dados['nome']);
        $funcionario->setTurno($dados['turno']);
        $funcionario->setSalario($dados['salario']);
        $funcionario->setTipo($dados['tipo']);
        $funcionario->setData_Contratacao($dados['data_contratacao']);
        $funcionario->setCPF($dados['cpf']);
        $funcionario->setEmail($dados['mail']);
        $funcionario->setTelefone($dados['telefone']);
        $funcionario->setSenha(password_hash($dados['senha'], PASSWORD_DEFAULT));
        $funcionario->setCEP($dados['cep']);
        $funcionario->setCidade($dados['cidade']);
        $funcionario->setBairro($dados['bairro']);
        $funcionario->setEndereco($dados['endereco']);
        $funcionario->setNumero_Casa($dados['numero_casa']);
        
        $funcionario->setFoto($_FILES['foto']);
                
        if($funcionariodao->create($funcionario)){
            echo "<script>
                    alert('Funcionário cadastrado com sucesso!');
                    location.href = '../views/gestao_funcionarios_adm/index.php';
                </script>";
        }
        else{
            echo "<script>
            location.href = '../views/gestao_funcionario_adm/index.php';
            </script>";
        }

} else if(isset($_POST['alterar'])){

    $funcionario->setID($dados['id_funcionario']);
    $funcionario->setNome($dados['nome']);
    $funcionario->setTurno($dados['turno']);
    $funcionario->setSalario($dados['salario']);
    $funcionario->setTipo($dados['tipo']);
    $funcionario->setData_Contratacao($dados['data_contratacao']);
    $funcionario->setCPF($dados['cpf']);
    $funcionario->setEmail($dados['mail']);
    $funcionario->setTelefone($dados['telefone']);
    $funcionario->setSenha(password_hash($dados['senha'], PASSWORD_DEFAULT));
    $funcionario->setCEP($dados['cep']);
    $funcionario->setCidade($dados['cidade']);
    $funcionario->setBairro($dados['bairro']);
    $funcionario->setEndereco($dados['endereco']);
    $funcionario->setNumero_Casa($dados['numero_casa']);

    $funcionario->setFoto($_FILES['foto']);

    $img = $_POST['foto'];

    if($funcionariodao->alterar($funcionario)) {

      $del_img = "../img/$img";
      unlink($del_img);

        if(!is_file($del_img)){  
            echo "<script>
                    alert('Funcionário Atualizado com Sucesso!!');
                    location.href = '../views/gestao_funcionarios_adm/index.php';
                </script>";
        }
    }
}else if(isset($_POST['excluir'])) {
  
    $funcionario->setID($_POST['id_funcionario']);

    if($funcionariodao->excluir($funcionario)) {

    echo "<script>
            alert('Funcionario Deletado com Sucesso!!');
            location.href = '../views/gestao_funcionarios_adm/index.php';
        </script>";
    }
    else{
        echo "<script>
            alert('Esse Funcionario já está atribuído em um Ticket. Para apagá-lo, delete o Ticket em questão.');
            location.href = '../views/gestao_funcionarios_adm/index.php';
        </script>";
    }
    }
    else{
        header("Location: ../");
    }
