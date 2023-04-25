<?php

class ClienteDao {

    public function create(Cliente $cliente){
        try{
            $sql = "INSERT INTO cliente (nome, telefone, telefone_fixo) VALUES
            (:nome, :telefone, :telefone_fixo)";

            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->bindValue(":nome", $cliente->getNome(), PDO::PARAM_STR);
            $stmt->bindValue(":telefone", $cliente->getTelefone(), PDO::PARAM_STR);
            $stmt->bindValue(":telefone_fixo", $cliente->getTelefone_Fixo(), PDO::PARAM_STR);

            return $stmt->execute();

        }   
        catch(PDOException $e){
            echo "<script> alert('Atenção! Já existe um cliente com esse número de telefone cadastrado.'); 
            location.href = '../';
            </script>";

        }
    }

    public function alterar(Cliente $cliente){
        try {
            $sql = "UPDATE cliente SET nome = :nome, telefone = :telefone, telefone_fixo = :telefone_fixo WHERE id_cliente = :id";
    
            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->bindValue(":id", $cliente->getID(), PDO::PARAM_INT);
            $stmt->bindValue(":nome", $cliente->getNome(), PDO::PARAM_STR);
            $stmt->bindValue(":telefone", $cliente->getTelefone(), PDO::PARAM_STR);
            $stmt->bindValue(":telefone_fixo", $cliente->getTelefone_Fixo(), PDO::PARAM_STR);
            return $stmt->execute();

        } catch (PDOException $e) {
            echo "Ocorreu um erro ao alterar um cliente!!".$e->getMessage();
        }
    }

    public function excluir(Cliente $cliente) {
        try {

            $sql = "DELETE FROM cliente WHERE id_cliente = :id";
            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->bindValue(":id", $cliente->getID(), PDO::PARAM_INT);
            return $stmt->execute();

        } catch (PDOException $e) {
            echo "Erro ao Excluir cliente" . $e->getMessage();
        }
    }

    public function listAdm(){
        try{
            $sql = "SELECT c.id_cliente, c.nome, c.telefone, COUNT(t.id_ticket) FROM cliente AS c LEFT JOIN ticket AS t ON t.id_cliente = c.id_cliente GROUP BY c.id_cliente ORDER BY c.nome ASC";
            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->execute();
            $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $list = array();
            foreach($lista as $linha){
                $list[] = $this->listaAdm($linha);
            }
            
            return $list;
        }
        catch(PDOException $e){
            echo 'Erro ao listar';
        }
    }

    private function listaAdm($linhas){
        $cliente = new Cliente();
        $cliente->setID($linhas['id_cliente']);
        $cliente->setNome($linhas['nome']);
        $cliente->setTelefone($linhas['telefone']);
        $cliente->setTelefone_Fixo($linhas['telefone_fixo']);
        $cliente->setTotal_Pedidos($linhas['COUNT(t.id_ticket)']);
        return $cliente;
    }

    public function listAllNames(){
        try{
            $sql = "SELECT id_cliente, nome, telefone FROM cliente order by nome asc";
            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->execute();
            $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $list = array();
            foreach($lista as $linha){
                $list[] = $this->listaAllNames($linha);
            }
            
            return $list;
        }
        catch(PDOException $e){
            echo 'Erro ao listar';
        }
    }

    private function listaAllNames($linhas){
        $cliente = new Cliente();
        $cliente->setID($linhas['id_cliente']);
        $cliente->setNome($linhas['nome']);
        $cliente->setTelefone($linhas['telefone']);

        return $cliente;
    }

    public function findIDByName(Cliente $cliente){
        try{
            $sql = "SELECT id_cliente FROM cliente WHERE nome = :nome";
            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->bindValue(":nome", $cliente->getNome(), PDO::PARAM_STR);
            $stmt->execute();
            $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $list = array();

            foreach($lista as $linha){
                $list[] = $this->listaClienteByName($linha);
            }
            return $list;
        }   
        catch(PDOException $e){
            echo "Erro ao pesquisar cliente por nome";
        }
    }

    private function listaClienteByName($linhas){
        $cliente = new Cliente();
        $cliente->setID($linhas['id_cliente']);
        return $cliente;
    }

    public function findById1($id){
        try{
            $sql = "SELECT nome FROM cliente WHERE id_cliente = :id_cliente";
            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->bindValue(":id_cliente", $id, PDO::PARAM_INT);
            $stmt->execute();
            $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $list = array();

            foreach($lista as $linha){
                $list[] = $this->listaClientes1($linha);
            }
            return $list;
        }   
        catch(PDOException $e){
            echo "Erro ao pesquisar cliente por nome";
        }
    }

    private function listaClientes1($linhas){
        $cliente = new Cliente();
        $cliente->setNome($linhas['nome']);
        return $cliente;
    }

    public function filtragem(){

        if($_POST['filtragem_pedidos'] == 1){

            try{
                $sql = "SELECT c.id_cliente, c.nome, c.telefone, c.telefone_fixo, COUNT(t.id_ticket) FROM cliente AS c LEFT JOIN ticket AS t ON t.id_cliente = c.id_cliente GROUP BY c.id_cliente ORDER BY c.nome DESC";
                $stmt = Conexao::getConexao()->prepare($sql);
                $stmt->execute();
                $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $list = array();
                foreach($lista as $linha){
                    $list[] = $this->listaAdm($linha);
                }
                
                return $list;
            }
            catch(PDOException $e){
                echo 'Erro ao listar';
            }

    }else if($_POST['filtragem_pedidos'] == 2){

        try{
            $sql = "SELECT c.id_cliente, c.nome, c.telefone, c.telefone_fixo, COUNT(t.id_ticket) FROM cliente AS c LEFT JOIN ticket AS t ON t.id_cliente = c.id_cliente GROUP BY c.id_cliente ORDER BY c.nome ASC";
            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->execute();
            $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $list = array();
            foreach($lista as $linha){
                $list[] = $this->listaAdm($linha);
            }
            
            return $list;
        }
        catch(PDOException $e){
            echo 'Erro ao listar';
        }

    }else if($_POST['filtragem_pedidos'] == 3){

        try{
            $sql = "SELECT c.id_cliente, c.nome, c.telefone, c.telefone_fixo, COUNT(t.id_ticket) FROM cliente AS c LEFT JOIN ticket AS t ON t.id_cliente = c.id_cliente GROUP BY c.id_cliente ORDER BY COUNT(t.id_ticket) ASC";
            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->execute();
            $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $list = array();
            foreach($lista as $linha){
                $list[] = $this->listaAdm($linha);
            }
            
            return $list;
        }
        catch(PDOException $e){
            echo 'Erro ao listar';
        }

    }else if($_POST['filtragem_pedidos'] == 4){

        try{
            $sql = "SELECT c.id_cliente, c.nome, c.telefone, c.telefone_fixo, COUNT(t.id_ticket) FROM cliente AS c LEFT JOIN ticket AS t ON t.id_cliente = c.id_cliente GROUP BY c.id_cliente ORDER BY COUNT(t.id_ticket) DESC";
            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->execute();
            $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $list = array();
            foreach($lista as $linha){
                $list[] = $this->listaAdm($linha);
            }
            
            return $list;
        }
        catch(PDOException $e){
            echo 'Erro ao listar';
        }

    }else{

        try{
            $sql = "SELECT c.id_cliente, c.nome, c.telefone, c.telefone_fixo, COUNT(t.id_ticket) FROM cliente AS c LEFT JOIN ticket AS t ON t.id_cliente = c.id_cliente GROUP BY c.id_cliente";
            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->execute();
            $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $list = array();
            foreach($lista as $linha){
                $list[] = $this->listaAdm($linha);
            }
            
            return $list;
        }
        catch(PDOException $e){
            echo 'Erro ao listar';
        }

    }

    }
    
}

?>