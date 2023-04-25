<?php

class TicketDao {

    var Ticket $ticket2;

    public function create(Ticket $ticket){
        try{
            $sql = "INSERT INTO ticket (data_criacao, data_entrega, valor_final, status, id_funcionario, id_cliente, nome_pacote, observacao, cidade, bairro, endereco, numero_casa) VALUES
            (:data_criacao, :data_entrega, :valor_final, :status, :id_funcionario, :id_cliente, :nome_pacote, :observacao, :cidade, :bairro, :endereco, :numero_casa)";

            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->bindValue(":data_criacao", $ticket->getDataCriacao(), PDO::PARAM_STR);
            $stmt->bindValue(":data_entrega", $ticket->getDataEntrega(), PDO::PARAM_STR);
            $stmt->bindValue(":valor_final", $ticket->getValor_Final(), PDO::PARAM_STR);
            $stmt->bindValue(":status", $ticket->getStatus(), PDO::PARAM_STR);
            $stmt->bindValue(":id_funcionario", $ticket->getID_Funcionario(), PDO::PARAM_INT);
            $stmt->bindValue(":id_cliente", $ticket->getID_Cliente(), PDO::PARAM_INT);
            $stmt->bindValue(":nome_pacote", $ticket->getNome_Pacote(), PDO::PARAM_STR);
            $stmt->bindValue(":observacao", $ticket->getObservacao(), PDO::PARAM_STR);
            $stmt->bindValue(":cidade", $ticket->getCidade(), PDO::PARAM_STR);
            $stmt->bindValue(":bairro", $ticket->getBairro(), PDO::PARAM_STR);
            $stmt->bindValue(":endereco", $ticket->getEndereco(), PDO::PARAM_STR);
            $stmt->bindValue(":numero_casa", $ticket->getNumero_Casa(), PDO::PARAM_STR);

            return $stmt->execute();

        }   
        catch(PDOException $e){
            echo "Erro ao cadastrar um Ticket" . $e->getMessage();
        }
    }

    public function alterar(Ticket $ticket) {
        try {
            $sql = "UPDATE ticket SET data_entrega = :data_entrega, observacao = :observacao, cidade = :cidade, bairro = :bairro, endereco = :endereco, numero_casa = :numero_casa WHERE id_ticket = :id";

            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->bindValue(":id", $ticket->getID(), PDO::PARAM_INT);
            $stmt->bindValue(":data_entrega", $ticket->getDataEntrega(), PDO::PARAM_STR);
            $stmt->bindValue(":observacao", $ticket->getObservacao(), PDO::PARAM_STR);
            $stmt->bindValue(":cidade", $ticket->getCidade(), PDO::PARAM_STR);
            $stmt->bindValue(":bairro", $ticket->getBairro(), PDO::PARAM_STR);
            $stmt->bindValue(":endereco", $ticket->getEndereco(), PDO::PARAM_STR);
            $stmt->bindValue(":numero_casa", $ticket->getNumero_Casa(), PDO::PARAM_STR);

            return $stmt->execute();

        } catch (PDOException $e) {
            echo "Ocorreu um erro ao tentar atualizar Ticket." . $e->getMessage();
        }
    }

    public function editar() {
        try {
            $sql = "SELECT t.*, c.nome FROM ticket as t inner join cliente as c on t.id_cliente = c.id_cliente WHERE id_ticket = :id";
            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->bindValue(":id", $_POST['id_edit'], PDO::PARAM_INT);
            $stmt->execute();
            $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $list = array();
           
            foreach ($lista as $linha) {
                $list[] = $this->listaAll($linha);
            }

            return $list;

        } catch (PDOException $e) {
            echo "Ocorreu um erro ao tentar buscar Usuário." . $e->getMessage();
        }

    }

    public function calculaValorFinal()
    {
        try {
            $sql = "SELECT SUM(valor_final) FROM ticket
            WHERE MONTH(data_criacao) = MONTH(CURDATE());";
            $stmt = Conexao::getConexao()->query($sql);
            $valor = $stmt->fetchColumn();
            return $valor;
        } catch (PDOException $e) {
            echo "Erro ao listar valores";
        }
    }

    public function calculaValorFinalAno()
    {
        try {
            $sql = "SELECT SUM(valor_final) FROM ticket
            WHERE YEAR(data_criacao) = YEAR(CURDATE());";
            $stmt = Conexao::getConexao()->query($sql);
            $valor = $stmt->fetchColumn();
            return $valor;
        } catch (PDOException $e) {
            echo "Erro ao listar valores";
        }
    }

    public function calculaValorFinalPassado()
    {
        try {
            $sql = "SELECT SUM(valor_final) FROM ticket
            WHERE MONTH(data_criacao) = MONTH(DATE_SUB(CURDATE(), INTERVAL 1 MONTH));";
            $stmt = Conexao::getConexao()->query($sql);
            $valor = $stmt->fetchColumn();
            return $valor;
        } catch (PDOException $e) {
            echo "Erro ao listar valores";
        }
    }
    
    public function calculaValorFinalPassadoAno()
    {
        try {
            $sql = "SELECT SUM(valor_final) FROM ticket
            WHERE YEAR(data_criacao) = YEAR(DATE_SUB(CURDATE(), INTERVAL 1 MONTH));";
            $stmt = Conexao::getConexao()->query($sql);
            $valor = $stmt->fetchColumn();
            return $valor;
        } catch (PDOException $e) {
            echo "Erro ao listar valores";
        }
    }

    public function calculaValorFinalMes($mes){
    try {
        $sql = "SELECT SUM(valor_final) FROM ticket
        WHERE MONTH(data_criacao) = :mes;";
        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->bindValue(':mes', $mes, PDO::PARAM_INT);
        $stmt->execute();
        $valor = $stmt->fetchColumn();
        if($valor == null){
            $valor = 0;
        }
        return $valor;
    } catch (PDOException $e) {
        echo "Erro ao listar valores";
    }
}

public function contaPacote($pacote){
    try {
        $sql = "SELECT COUNT(*) FROM ticket WHERE nome_pacote = :nome;";
        $stmt = Conexao::getConexao()->prepare($sql);
        $stmt->bindValue(':nome', $pacote, PDO::PARAM_STR);
        $stmt->execute();
        $valor = $stmt->fetchColumn();
        if($valor == null){
            $valor = 0;
        }
        return $valor;
    } catch (PDOException $e) {
        echo "Erro ao listar valores";
    }
}

    private function listaAll($linhas){
        $ticket = new Ticket();
        $ticket->setID($linhas['id_ticket']);
        $ticket->setDataEntrega($linhas['data_entrega']);
        $ticket->setValor_Final($linhas['valor_final']);
        $ticket->setStatus($linhas['status']);
        $ticket->setNomeCliente($linhas['nome']);
        $ticket->setNome_Pacote($linhas['nome_pacote']);
        $ticket->setObservacao($linhas['observacao']);
        $ticket->setCidade($linhas['cidade']);
        $ticket->setBairro($linhas['bairro']);
        $ticket->setEndereco($linhas['endereco']);
        $ticket->setNumero_Casa($linhas['numero_casa']);
        return $ticket;
    }

    public function listTicketAdmin(){
        try{
            $sql = "SELECT t.id_ticket, t.data_entrega, t.valor_final, t.status, c.nome, f.nomef FROM funcionario as f inner join ticket as t ON f.id_funcionario = t.id_funcionario INNER JOIN cliente as c on c.id_cliente = t.id_cliente order by t.data_entrega desc";
            $stmt = Conexao::getConexao()->query($sql);
            $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $list = array();
           
            foreach($lista as $linha){
                $list[] = $this->listaInformacoesTicketAdmin($linha);
            }

            return $list;
        }   
        catch(PDOException $e){
            echo "Erro ao listar id de ticket" . $e;
        }
    }

    private function listaInformacoesTicketAdmin($linhas){
        $ticket = new Ticket();
        $ticket->setID($linhas['id_ticket']);
        $ticket->setDataEntrega($linhas['data_entrega']);
        $ticket->setValor_Final($linhas['valor_final']);
        $ticket->setStatus($linhas['status']);
        $palavras = explode(" ", $linhas['nome']); 
        $nome = implode(" ", array_slice($palavras, 0, 2)); 
        $ticket->setNomeCliente($nome);
        $palavras1 = explode(" ", $linhas['nomef']); 
        $nome1 = implode(" ", array_slice($palavras1, 0, 2)); 
        $ticket->setNomeFuncionario($nome1);
        return $ticket;
    }

    public function listID(){
        try{
            $sql = "SELECT id_ticket, data, id_cliente FROM ticket";
            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->execute();
            $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $list = array();

            foreach($lista as $linha){
                $list[] = $this->listaTicketsId($linha);
            }
            return $list;
        }   
        catch(PDOException $e){
            echo "Erro ao listar id de ticket";
        }
    }

    private function listaTicketsId($linhas){
        $ticket = new Ticket();
        $ticket->setID($linhas['id_ticket']); 
        $ticket->setID_Cliente($linhas['id_cliente']);
        $ticket->setDataCriacao($linhas['data_criacao']);
        $ticket->setDataEntrega($linhas['data_entrega']);
        return $ticket;
    }

    public function excluir(Ticket $ticket){
        try{
            $sql = "DELETE FROM ticket WHERE id_ticket = :id";
            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->bindValue(":id", $ticket->getID(), PDO::PARAM_INT);
            return $stmt->execute();
        }
        catch(PDOException $e){
            echo "Erro ao listar id de ticket" . $e;
        }
    }

    

    public function listIDPendente(){
        try{
            $sql = "SELECT id_ticket, id_cliente, data_entrega, COUNT(*) FROM ticket WHERE status = 'Cancelado' GROUP BY id_cliente, data_entrega HAVING COUNT(*) = 1 AND COUNT(DISTINCT status) = 1 ORDER BY data_entrega ASC";
            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->execute();
            $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $list = array();

            foreach($lista as $linha){
                $list[] = $this->listaTicketsId($linha);
            }
            return $list;
        }   
        catch(PDOException $e){
            echo "Erro ao listar id de ticket";
        }
    }

    public function listInformacoes(){
        
        if($_POST['filtragem_tickets'] == 1){

            try{
                $sql = "SELECT t.id_ticket, t.id_funcionario, t.id_cliente, t.cidade, t.bairro, t.endereco, t.numero_casa, t.data_criacao, t.data_entrega, t.valor_final, t.status, c.nome, c.telefone, c.telefone_fixo, t.observacao, t.nome_pacote FROM ticket as t inner join cliente as c WHERE t.id_funcionario = :id and c.id_cliente = t.id_cliente";
                $stmt = Conexao::getConexao()->prepare($sql);
                $stmt->bindValue(":id", $_SESSION['user_session'], PDO::PARAM_INT);
                $stmt->execute();
                $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $list = array();
            
                foreach($lista as $linha){
                    $list[] = $this->listaInformacoes($linha);
                }

                return $list;
            }   
            catch(PDOException $e){
                echo "Erro ao listar id de ticket" . $e;
            }

        }else if($_POST['filtragem_tickets'] == 2){

            try{
                $sql = "SELECT t.id_ticket, t.id_funcionario, t.id_cliente, t.cidade, t.bairro, t.endereco, t.numero_casa, t.data_criacao, t.data_entrega, t.valor_final, t.status, c.nome, c.telefone, c.telefone_fixo, t.observacao, t.nome_pacote FROM ticket as t inner join cliente as c WHERE t.id_funcionario = :id and c.id_cliente = t.id_cliente and t.status = 'Em andamento' order by t.data_entrega asc";
                $stmt = Conexao::getConexao()->prepare($sql);
                $stmt->bindValue(":id", $_SESSION['user_session'], PDO::PARAM_INT);
                $stmt->execute();
                $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $list = array();
            
                foreach($lista as $linha){
                    $list[] = $this->listaInformacoes($linha);
                }

                return $list;
            }   
            catch(PDOException $e){
                echo "Erro ao listar id de ticket" . $e;
            }

        }else if($_POST['filtragem_tickets'] == 3){

            try{
                $sql = "SELECT t.id_ticket, t.id_funcionario, t.id_cliente, t.cidade, t.bairro, t.endereco, t.numero_casa, t.data_criacao, t.data_entrega, t.valor_final, t.status, c.nome, c.telefone, c.telefone_fixo, t.observacao, t.nome_pacote FROM ticket as t inner join cliente as c WHERE t.id_funcionario = :id and c.id_cliente = t.id_cliente and t.status = 'Concluido' order by t.data_entrega asc";
                $stmt = Conexao::getConexao()->prepare($sql);
                $stmt->bindValue(":id", $_SESSION['user_session'], PDO::PARAM_INT);
                $stmt->execute();
                $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $list = array();
            
                foreach($lista as $linha){
                    $list[] = $this->listaInformacoes($linha);
                }

                return $list;
            }   
            catch(PDOException $e){
                echo "Erro ao listar id de ticket" . $e;
            }

        }else if($_POST['filtragem_tickets'] == 4){

            try{
                $sql = "SELECT t.id_ticket, t.id_funcionario, t.id_cliente, t.cidade, t.bairro, t.endereco, t.numero_casa, t.data_criacao, t.data_entrega, t.valor_final, t.status, c.nome, c.telefone, c.telefone_fixo, t.observacao, t.nome_pacote FROM ticket as t inner join cliente as c WHERE t.id_funcionario = :id and c.id_cliente = t.id_cliente and t.status = 'Cancelado' order by t.data_entrega asc";
                $stmt = Conexao::getConexao()->prepare($sql);
                $stmt->bindValue(":id", $_SESSION['user_session'], PDO::PARAM_INT);
                $stmt->execute();
                $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $list = array();
            
                foreach($lista as $linha){
                    $list[] = $this->listaInformacoes($linha);
                }

                return $list;
            }   
            catch(PDOException $e){
                echo "Erro ao listar id de ticket" . $e;
            }

        }else{
        
            try{
                $sql = "SELECT t.id_ticket, t.id_funcionario, t.id_cliente, t.cidade, t.bairro, t.endereco, t.numero_casa, t.data_criacao, t.data_entrega, t.valor_final, t.status, c.nome, c.telefone, c.telefone_fixo, t.observacao, t.nome_pacote FROM ticket as t inner join cliente as c WHERE t.id_funcionario = :id and c.id_cliente = t.id_cliente order by t.data_entrega asc";
                $stmt = Conexao::getConexao()->prepare($sql);
                $stmt->bindValue(":id", $_SESSION['user_session'], PDO::PARAM_INT);
                $stmt->execute();
                $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $list = array();
            
                foreach($lista as $linha){
                    $list[] = $this->listaInformacoes($linha);
                }

                return $list;
            }   
            catch(PDOException $e){
                echo "Erro ao listar id de ticket" . $e;
            }
        }
    }

    private function listaInformacoes($linhas){
        $ticket = new Ticket();
        $ticket->setID($linhas['id_ticket']);
        $ticket->setID_Funcionario($linhas['id_funcionario']);
        $ticket->setID_Cliente($linhas['id_cliente']);
        $ticket->setCidade($linhas['cidade']);
        $ticket->setBairro($linhas['bairro']);
        $ticket->setEndereco($linhas['endereco']);
        $ticket->setNumero_Casa($linhas['numero_casa']);
        $ticket->setDataCriacao($linhas['data_criacao']);
        $ticket->setDataEntrega($linhas['data_entrega']);
        $ticket->setValor_Final($linhas['valor_final']);
        $ticket->setStatus($linhas['status']);
        $palavras = explode(" ", $linhas['nome']); 
        $nome = implode(" ", array_slice($palavras, 0, 2)); 
        $ticket->setNomeCliente($nome);
        $ticket->setCelularCliente($linhas['telefone']);
        $ticket->setTelefoneCliente($linhas['telefone_fixo']);
        $ticket->setObservacao($linhas['observacao']);
        $ticket->setNome_Pacote($linhas['nome_pacote']);
        return $ticket;
    }

    public function listagemFiltros(){

        if($_POST['filtragem_tickets'] == 1){

            try{
                $sql = "SELECT t.id_ticket, t.data_entrega, t.valor_final, t.status, c.nome, f.nomef FROM funcionario as f inner join ticket as t ON f.id_funcionario = t.id_funcionario INNER JOIN cliente as c on c.id_cliente = t.id_cliente WHERE t.status = 'Cancelado' order by t.data_entrega asc";
                $stmt = Conexao::getConexao()->query($sql);
                $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $list = array();
               
                foreach($lista as $linha){
                    $list[] = $this->listaInformacoesTicketAdmin($linha);
                }
    
                return $list;
            }   
            catch(PDOException $e){
                echo "Erro ao listar id de ticket" . $e;
            }

        }else if($_POST['filtragem_tickets'] == 2){

            try{
                $sql = "SELECT t.id_ticket, t.data_entrega, t.valor_final, t.status, c.nome, f.nomef FROM funcionario as f inner join ticket as t ON f.id_funcionario = t.id_funcionario INNER JOIN cliente as c on c.id_cliente = t.id_cliente WHERE t.status = 'Em andamento' order by t.data_entrega asc";
                $stmt = Conexao::getConexao()->query($sql);
                $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $list = array();
               
                foreach($lista as $linha){
                    $list[] = $this->listaInformacoesTicketAdmin($linha);
                }
    
                return $list;
            }   
            catch(PDOException $e){
                echo "Erro ao listar id de ticket" . $e;
            }

        }else if($_POST['filtragem_tickets'] == 3){
            
            try{
                $sql = "SELECT t.id_ticket, t.data_entrega, t.valor_final, t.status, c.nome, f.nomef FROM funcionario as f inner join ticket as t ON f.id_funcionario = t.id_funcionario INNER JOIN cliente as c on c.id_cliente = t.id_cliente WHERE t.status = 'Concluido' order by t.data_entrega asc";
                $stmt = Conexao::getConexao()->query($sql);
                $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $list = array();
               
                foreach($lista as $linha){
                    $list[] = $this->listaInformacoesTicketAdmin($linha);
                }
    
                return $list;
            }   
            catch(PDOException $e){
                echo "Erro ao listar id de ticket" . $e;
            }

        }else{

            try{
                $sql = "SELECT t.id_ticket, t.data_entrega, t.valor_final, t.status, c.nome, f.nomef FROM funcionario as f inner join ticket as t ON f.id_funcionario = t.id_funcionario INNER JOIN cliente as c on c.id_cliente = t.id_cliente order by t.data_entrega asc";
                $stmt = Conexao::getConexao()->query($sql);
                $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $list = array();
               
                foreach($lista as $linha){
                    $list[] = $this->listaInformacoesTicketAdmin($linha);
                }
    
                return $list;
            }   
            catch(PDOException $e){
                echo "Erro ao listar id de ticket" . $e;
            }

        }
    }

    public function alterarStatusCancel(Ticket $ticket){
        try{
            $sql = "UPDATE ticket SET status = 'Cancelado' WHERE id_ticket = :id";
            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->bindValue(":id", $ticket->getID(), PDO::PARAM_INT);
            return $stmt->execute();
        }
        catch(PDOException $e){
            echo "Erro ao atualizar status de ticket" . $e;
        }
    }

    public function alterarStatusAndamento(Ticket $ticket){
        try{
            $sql = "UPDATE ticket SET status = 'Em andamento' WHERE id_ticket = :id";
            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->bindValue(":id", $ticket->getID(), PDO::PARAM_INT);
            return $stmt->execute();
        }
        catch(PDOException $e){
            echo "Erro ao atualizar status de ticket" . $e;
        }
    }

    public function alterarStatusConcluido(Ticket $ticket){
        try{
            $sql = "UPDATE ticket SET status = 'Concluido' WHERE id_ticket = :id";
            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->bindValue(":id", $ticket->getID(), PDO::PARAM_INT);
            return $stmt->execute();
        }
        catch(PDOException $e){
            echo "Erro ao atualizar status de ticket" . $e;
        }
    }

}

?>