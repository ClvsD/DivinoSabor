<?php

require_once('../config/Conexao.php');
require_once('../dao/TicketDao.php');
require_once('../model/Ticket.php');


$ticket = new Ticket();
$ticketdao = new TicketDao();

$dados = filter_input_array(INPUT_POST);

if(isset($_POST['create'])){
    $ticket->setDataCriacao($dados['data_criacao']);
    $ticket->setDataEntrega($dados['data_entrega']);
    $ticket->setValor_Final($dados['valor_final']);
    $ticket->setStatus($dados['status']);
    $ticket->setID_Funcionario($dados['id_funcionario']);
    $ticket->setID_Cliente($dados['id_cliente']);
    $ticket->setNome_Pacote($dados['nome_pacote']);
    $ticket->setObservacao($dados['observacao']);
    $ticket->setCidade($dados['cidade']);
    $ticket->setBairro($dados['bairro']);
    $ticket->setEndereco($dados['endereco']);
    $ticket->setNumero_Casa($dados['numero_casa']);

    if($ticketdao->create($ticket)){
        echo "<script>
        alert('Cadastrado com sucesso');
        location.href = '../';
        </script>
        ";
    }
} else if(isset($_POST['alterar'])){

    $ticket->setID($dados['id_ticket']);
    $ticket->setDataEntrega($dados['data_entrega']);
    $ticket->setObservacao($dados['observacao']);
    $ticket->setCidade($dados['cidade']);
    $ticket->setBairro($dados['bairro']);
    $ticket->setEndereco($dados['endereco']);
    $ticket->setNumero_Casa($dados['numero_casa']);

    if($ticketdao->alterar($ticket)) {

            echo "<script>
                    alert('Ticket Atualizado com Sucesso!!');
                    location.href = '../';
                </script>";
    }
}else if(isset($_POST['StatusCancelado'])){

    $ticket->setID($dados['id_ticket']);

    if($ticketdao->alterarStatusCancel($ticket)) {
            echo "<script>
                    alert('Ticket Atualizado com Sucesso!!');
                    location.href = '../';
                </script>";
        
    }

}else if(isset($_POST['StatusAndamento'])){

    $ticket->setID($dados['id_ticket']);

    if($ticketdao->alterarStatusAndamento($ticket)) {
            echo "<script>
                    alert('Ticket Atualizado com Sucesso!!');
                    location.href = '../';
                </script>";
        
    }
    
}else if(isset($_POST['StatusConcluido'])){

    $ticket->setID($dados['id_ticket']);

    if($ticketdao->alterarStatusConcluido($ticket)) {
            echo "<script>
                    alert('Ticket Atualizado com Sucesso!!');
                    location.href = '../';
                </script>";
        
    }
    
}else if (isset($_POST['excluir'])){

    $ticket->setID($_POST['id_deletar']);

    if($ticketdao->excluir($ticket)){
        echo    "<script> 
                    alert('Ticket deletado com sucesso!!');
                    location.href = '../'; 
                </script>";
    }

}else if (isset($_POST['cancelar'])){

    $ticket->setID($_POST['id_ticket']);

    if($ticketdao->cancelar($ticket)){
        echo    "<script> 
                    alert('Ticket cancelado com sucesso!!');
                    location.href = '../'; 
                </script>";
    }

}else{
    header("Location: ../");
}
            

?>