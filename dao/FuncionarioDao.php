<?php

class FuncionarioDao
{

    public function create(Funcionario $funcionario)
    {
        try {
            $sql = "INSERT INTO funcionario (nomef, turno, salario, tipo, data_contratacao, cpf, email, telefone, senha, cep, cidade, bairro, endereco, numero_casa, foto) VALUES (:nomef, :turno, :salario, :tipo, :data_contratacao, :cpf, :email, :telefone, :senha, :cep, :cidade, :bairro, :endereco, :numero_casa, :foto)";

            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->bindValue(":nomef", $funcionario->getNome(), PDO::PARAM_STR);
            $stmt->bindValue(":turno", $funcionario->getTurno(), PDO::PARAM_STR);
            $stmt->bindValue(":salario", $funcionario->getSalario(), PDO::PARAM_STR);
            $stmt->bindValue(":tipo", $funcionario->getTipo(), PDO::PARAM_STR);
            $stmt->bindValue(":data_contratacao", $funcionario->getData_Contratacao(), PDO::PARAM_STR);
            $stmt->bindValue(":cpf", $funcionario->getCPF(), PDO::PARAM_STR);
            $stmt->bindValue(":email", $funcionario->getEmail(), PDO::PARAM_STR);
            $stmt->bindValue(":telefone", $funcionario->getTelefone(), PDO::PARAM_STR);
            $stmt->bindValue(":senha", $funcionario->getSenha(), PDO::PARAM_STR);
            $stmt->bindValue(":cep", $funcionario->getCEP(), PDO::PARAM_STR);
            $stmt->bindValue(":cidade", $funcionario->getCidade(), PDO::PARAM_STR);
            $stmt->bindValue(":bairro", $funcionario->getBairro(), PDO::PARAM_STR);
            $stmt->bindValue(":endereco", $funcionario->getEndereco(), PDO::PARAM_STR);
            $stmt->bindValue(":numero_casa", $funcionario->getNumero_Casa(), PDO::PARAM_STR);

            $nomep = $funcionario->getNome();
            $imagem = $funcionario->getFoto();
            include '../includes/upload_img.php';
            $stmt->bindValue(":foto", $nome_imagem, PDO::PARAM_STR);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao inserir funcionario no banco no banco de dados." . $e->getMessage();
        }
    }

    public function alterar(Funcionario $funcionario)
    {
        try {
            $sql = "UPDATE funcionario SET nomef = :nomef, turno = :turno, salario = :salario, tipo = :tipo, data_contratacao = :data_contratacao, cpf = :cpf, email = :email, telefone = :telefone, senha = :senha, cep = :cep, cidade = :cidade, bairro = :bairro, endereco = :endereco, numero_casa = :numero_casa, foto = :foto WHERE id_funcionario = :id";

            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->bindValue(":id", $funcionario->getID(), PDO::PARAM_INT);
            $stmt->bindValue(":nomef", $funcionario->getNome(), PDO::PARAM_STR);
            $stmt->bindValue(":turno", $funcionario->getTurno(), PDO::PARAM_STR);
            $stmt->bindValue(":salario", $funcionario->getSalario(), PDO::PARAM_STR);
            $stmt->bindValue(":tipo", $funcionario->getTipo(), PDO::PARAM_STR);
            $stmt->bindValue(":data_contratacao", $funcionario->getData_Contratacao(), PDO::PARAM_STR);
            $stmt->bindValue(":cpf", $funcionario->getCPF(), PDO::PARAM_STR);
            $stmt->bindValue(":email", $funcionario->getEmail(), PDO::PARAM_STR);
            $stmt->bindValue(":telefone", $funcionario->getTelefone(), PDO::PARAM_STR);
            $stmt->bindValue(":senha", $funcionario->getSenha(), PDO::PARAM_STR);
            $stmt->bindValue(":cep", $funcionario->getCEP(), PDO::PARAM_STR);
            $stmt->bindValue(":cidade", $funcionario->getCidade(), PDO::PARAM_STR);
            $stmt->bindValue(":bairro", $funcionario->getBairro(), PDO::PARAM_STR);
            $stmt->bindValue(":endereco", $funcionario->getEndereco(), PDO::PARAM_STR);
            $stmt->bindValue(":numero_casa", $funcionario->getNumero_Casa(), PDO::PARAM_STR);

            $nomep = $funcionario->getNome();
            $imagem = $funcionario->getFoto();
            include '../includes/upload_img.php';
            $stmt->bindValue(":foto", $nome_imagem, PDO::PARAM_STR);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Ocorreu um erro ao tentar atualizar Funcionário." . $e->getMessage();
        }
    }

    public function editar()
    {
        try {
            $sql = "SELECT * FROM funcionario WHERE id_funcionario = :id";
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

    public function excluir(Funcionario $funcionario)
    {
        try {

            $sql = "DELETE FROM funcionario WHERE id_funcionario = :id";
            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->bindValue(":id", $funcionario->getID(), PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao Excluir funcionario" . $e->getMessage();
        }
    }

    public function calculaSalarioTotal()
    {
        try {
            $sql = "SELECT SUM(salario) FROM funcionario;";
            $stmt = Conexao::getConexao()->query($sql);
            $valor = $stmt->fetchColumn();
            return $valor;
        } catch (PDOException $e) {
            echo "Erro ao listar funcionarios";
        }
    }

    public function listaVendaFuncionarios()
    {
        try {
            $sql = "SELECT f.nomef, COUNT(*) as total_tickets 
            FROM ticket t 
            INNER JOIN funcionario f ON t.id_funcionario = f.id_funcionario 
            WHERE MONTH(t.data_criacao) = MONTH(CURDATE()) 
            GROUP BY t.id_funcionario 
            ORDER BY total_tickets DESC;";
            $stmt = Conexao::getConexao()->query($sql);
            $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $list = array();

            foreach ($lista as $linha) {
                $list[] = $this->listaFuncionarioDoMes($linha);
            }
            return $list;
        } catch (PDOException $e) {
            echo "Erro ao listar funcionarios";
        }
    }

    public function funcionarioDoMes()
    {
        try {
            $sql = "SELECT f.nomef, COUNT(*) as total_tickets 
            FROM ticket t 
            INNER JOIN funcionario f ON t.id_funcionario = f.id_funcionario 
            WHERE MONTH(t.data_criacao) = MONTH(CURDATE()) 
            GROUP BY t.id_funcionario 
            ORDER BY total_tickets DESC 
            LIMIT 1";
            $stmt = Conexao::getConexao()->query($sql);
            $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $list = array();

            foreach ($lista as $linha) {
                $list[] = $this->listaFuncionarioDoMes($linha);
            }
            return $list;
        } catch (PDOException $e) {
            echo "Erro ao listar funcionarios";
        }
    }

        public function funcionarioDoAno()

        
    {
        
        try {
            $sql = "SELECT f.nomef, COUNT(*) as total_tickets 
            FROM ticket t 
            INNER JOIN funcionario f ON t.id_funcionario = f.id_funcionario 
            WHERE YEAR(t.data_criacao) = YEAR(CURDATE()) 
            GROUP BY t.id_funcionario 
            ORDER BY total_tickets DESC 
            LIMIT 1";
            $stmt = Conexao::getConexao()->query($sql);
            $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $list = array();

            foreach ($lista as $linha) {
                $list[] = $this->listaFuncionarioDoMes($linha);
            }
            return $list;
        } catch (PDOException $e) {
            echo "Erro ao listar funcionarios";
        }
    }

    private function listaFuncionarioDoMes($linhas)
    {
        $funcionario = new Funcionario();
        $funcionario->setNome($linhas['nomef']);
        $funcionario->setNumero_Vendas($linhas['total_tickets']);

        return $funcionario;
    }

    private function listaAll($linhas)
    {
        $funcionario = new Funcionario();

        $funcionario->setID($linhas['id_funcionario']);
        $funcionario->setNome($linhas['nomef']);
        $funcionario->setTurno($linhas['turno']);
        $funcionario->setSalario($linhas['salario']);
        $funcionario->setTipo($linhas['tipo']);
        $funcionario->setData_Contratacao($linhas['data_contratacao']);
        $funcionario->setCPF($linhas['cpf']);
        $funcionario->setEmail($linhas['email']);
        $funcionario->setTelefone($linhas['telefone']);
        $funcionario->setSenha($linhas['senha']);
        $funcionario->setCEP($linhas['cep']);
        $funcionario->setCidade($linhas['cidade']);
        $funcionario->setBairro($linhas['bairro']);
        $funcionario->setEndereco($linhas['endereco']);
        $funcionario->setNumero_Casa($linhas['numero_casa']);
        $funcionario->setFoto($linhas['foto']);

        return $funcionario;
    }

    public function listGestaoAdm()
    {
        try {
            $sql = "SELECT nomef, turno, tipo, salario FROM funcionario order by nomef asc";
            $stmt = Conexao::getConexao()->query($sql);
            $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $list = array();

            foreach ($lista as $linha) {
                $list[] = $this->listaFuncionariosAdm($linha);
            }
            return $list;
        } catch (PDOException $e) {
            echo "Erro ao listar funcionarios";
        }
    }

    private function listaFuncionariosAdm($linhas)
    {
        $funcionario = new Funcionario();
        $funcionario->setID($linhas['id_funcionario']);
        $funcionario->setNome($linhas['nomef']);
        $palavras = explode(" ", $linhas['nomef']); 
        $nome = implode(" ", array_slice($palavras, 0, 2)); 
        $funcionario->setNome($nome);
        $funcionario->setTurno($linhas['turno']);
        $funcionario->setTipo($linhas['tipo']);
        $funcionario->setSalario($linhas['salario']);
        $funcionario->setCPF($linhas['cpf']);
        return $funcionario;
    }

    public function funcionario()
    {
        try {
            $sql = "SELECT id_funcionario, nomef, tipo FROM funcionario WHERE id_funcionario = :id_funcionario";
            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->bindValue(":id_funcionario", $_SESSION['user_session'], PDO::PARAM_INT);
            $stmt->execute();
            $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $list = array();

            foreach ($lista as $linha) {
                $list[] = $this->listaFuncionariosLogin($linha);
            }
            return $list;
        } catch (PDOException $e) {
            echo "Ocorreu um erro ao tentar buscar o Funcionário" . $e->getMessage();
        }
    }

    public function findById($id)
    {
        try {
            $sql = "SELECT nomef FROM funcionario WHERE id_funcionario = :id_funcionario";
            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->bindValue(":id_funcionario", $id, PDO::PARAM_INT);
            $stmt->execute();
            $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $list = array();

            foreach ($lista as $linha) {
                $list[] = $this->listaFuncionarios($linha);
            }
            return $list;
        } catch (PDOException $e) {
            echo "Erro ao pesquisar funcionario por id";
        }
    }

    private function listaFuncionarios($linhas)
    {
        $funcionario = new Funcionario();
        $funcionario->setNome($linhas['nomef']);
        return $funcionario;
    }

    private function listaFuncionariosLogin($linhas)
    {
        $funcionario = new Funcionario();
        $funcionario->setID($linhas['id_funcionario']);
        $funcionario->setNome($linhas['nomef']);
        $funcionario->setTipo($linhas['tipo']);

        return $funcionario;
    }

    public function checkAdmin()
    {
        try {
            $sql = "SELECT tipo FROM funcionario WHERE id_funcionario = :id;";
            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->bindValue(":id", $_SESSION['user_session'], PDO::PARAM_INT);
            $stmt->execute();
            $valor = $stmt->fetchColumn();
            return $valor;
        } catch (PDOException $e) {
            echo "Erro ao checar admin";
        }
    }

    public function retornaNome()
    {
        try {
            $sql = "SELECT nomef FROM funcionario WHERE id_funcionario = :id;";
            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->bindValue(":id", $_SESSION['user_session'], PDO::PARAM_INT);
            $stmt->execute();
            $valor = $stmt->fetchColumn();
            $palavras = explode(" ", $valor); // Divide a string em um array de palavras
            $nome = implode(" ", array_slice($palavras, 0, 2)); // Seleciona as duas primeiras palavras e as une novamente em uma string
            return $nome;
        } catch (PDOException $e) {
            echo "Erro ao checar nome";
        }
    }

    public function retornaImagem()
    {
        try {
            $sql = "SELECT foto FROM funcionario WHERE id_funcionario = :id;";
            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->bindValue(":id", $_SESSION['user_session'], PDO::PARAM_INT);
            $stmt->execute();
            $valor = $stmt->fetchColumn();
            return $valor;
        } catch (PDOException $e) {
            echo "Erro ao checar imagem";
        }
    }

    public function login(Funcionario $funcionario)
    {
        try {
            $sql = "SELECT id_funcionario, senha FROM funcionario WHERE cpf = :cpf";
            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->bindValue(":cpf", $funcionario->getCPF(), PDO::PARAM_STR);
            $stmt->execute();
            $user_linha = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($stmt->rowCount() == 1) {
                if (password_verify($funcionario->getSenha(), $user_linha['senha'])) {
                    $_SESSION['user_session'] = $user_linha['id_funcionario'];
                    error_reporting(0);
                    session_start();
                    error_reporting(1);
                    return true;
                } else {
                    return false;
                }
            }
        } catch (PDOException $e) {
            echo "Erro ao realizar login" . $e->getMessage();
        }
    }

    public function checkLogin()
    {
        if (isset($_SESSION['user_session'])) {
            return true;
        } else {
            return false;
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        unset($_SESSION['user_session']);
        return true;
    }

    public function listagemFiltros()
    {

        if ($_POST['filtragem_funcionarios'] == 1) {

            try {
                $sql = "SELECT id_funcionario, nomef, turno, tipo, salario, cpf FROM funcionario order by nomef desc";
                $stmt = Conexao::getConexao()->query($sql);
                $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $list = array();

                foreach ($lista as $linha) {
                    $list[] = $this->listaFuncionariosAdm($linha);
                }
                return $list;
            } catch (PDOException $e) {
                echo "Erro ao listar funcionarios";
            }
        } else if ($_POST['filtragem_funcionarios'] == 2) {

            try {
                $sql = "SELECT id_funcionario, nomef, turno, tipo, salario, cpf FROM funcionario order by nomef asc";
                $stmt = Conexao::getConexao()->query($sql);
                $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $list = array();

                foreach ($lista as $linha) {
                    $list[] = $this->listaFuncionariosAdm($linha);
                }
                return $list;
            } catch (PDOException $e) {
                echo "Erro ao listar funcionarios";
            }
        } else if ($_POST['filtragem_funcionarios'] == 3) {

            try {
                $sql = "SELECT id_funcionario, nomef, turno, tipo, salario, cpf FROM funcionario order by turno desc";
                $stmt = Conexao::getConexao()->query($sql);
                $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $list = array();

                foreach ($lista as $linha) {
                    $list[] = $this->listaFuncionariosAdm($linha);
                }
                return $list;
            } catch (PDOException $e) {
                echo "Erro ao listar funcionarios";
            }
        } else if ($_POST['filtragem_funcionarios'] == 4) {

            try {
                $sql = "SELECT id_funcionario, nomef, turno, tipo, salario, cpf FROM funcionario order by turno asc";
                $stmt = Conexao::getConexao()->query($sql);
                $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $list = array();

                foreach ($lista as $linha) {
                    $list[] = $this->listaFuncionariosAdm($linha);
                }
                return $list;
            } catch (PDOException $e) {
                echo "Erro ao listar funcionarios";
            }
        } else if ($_POST['filtragem_funcionarios'] == 5) {

            try {
                $sql = "SELECT id_funcionario, nomef, turno, tipo, salario, cpf FROM funcionario order by tipo desc";
                $stmt = Conexao::getConexao()->query($sql);
                $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $list = array();

                foreach ($lista as $linha) {
                    $list[] = $this->listaFuncionariosAdm($linha);
                }
                return $list;
            } catch (PDOException $e) {
                echo "Erro ao listar funcionarios";
            }
        } else if ($_POST['filtragem_funcionarios'] == 6) {

            try {
                $sql = "SELECT id_funcionario, nomef, turno, tipo, salario, cpf FROM funcionario order by tipo asc";
                $stmt = Conexao::getConexao()->query($sql);
                $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $list = array();

                foreach ($lista as $linha) {
                    $list[] = $this->listaFuncionariosAdm($linha);
                }
                return $list;
            } catch (PDOException $e) {
                echo "Erro ao listar funcionarios";
            }
        } else if ($_POST['filtragem_funcionarios'] == 7) {

            try {
                $sql = "SELECT id_funcionario, nomef, turno, tipo, salario, cpf FROM funcionario order by salario asc";
                $stmt = Conexao::getConexao()->query($sql);
                $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $list = array();

                foreach ($lista as $linha) {
                    $list[] = $this->listaFuncionariosAdm($linha);
                }
                return $list;
            } catch (PDOException $e) {
                echo "Erro ao listar funcionarios";
            }
        } else if ($_POST['filtragem_funcionarios'] == 8) {

            try {
                $sql = "SELECT id_funcionario, nomef, turno, tipo, salario, cpf FROM funcionario order by salario desc";
                $stmt = Conexao::getConexao()->query($sql);
                $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $list = array();

                foreach ($lista as $linha) {
                    $list[] = $this->listaFuncionariosAdm($linha);
                }
                return $list;
            } catch (PDOException $e) {
                echo "Erro ao listar funcionarios";
            }
        } else {

            try {
                $sql = "SELECT id_funcionario, nomef, turno, tipo, salario, cpf FROM funcionario";
                $stmt = Conexao::getConexao()->query($sql);
                $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $list = array();

                foreach ($lista as $linha) {
                    $list[] = $this->listaFuncionariosAdm($linha);
                }
                return $list;
            } catch (PDOException $e) {
                echo "Erro ao listar funcionarios";
            }
        }
    }
}
