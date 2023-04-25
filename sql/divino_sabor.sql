-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06-Abr-2023 às 02:00
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `divino_sabor`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `telefone_fixo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nome`, `telefone`, `telefone_fixo`) VALUES
(1, 'João Silva', '(11) 98765-4321', '(11) 2345-6789'),
(3, 'Pedro Oliveira', '(31) 99876-5432', '(31) 4567-8901'),
(4, 'Juliana Ferreira', '(41) 98765-4321', '(41) 5678-9012'),
(5, 'Lucas Souza', '(51) 91234-5678', '(51) 6789-0123'),
(6, 'Larissa Almeida', '(61) 99876-5432', '(61) 7890-1234'),
(7, 'Rafaela Santos', '(71) 98765-4321', '(71) 9012-3456'),
(8, 'Vinícius Oliveira', '(81) 91234-5678', '(81) 1234-5678'),
(9, 'Gabriel Silva', '(91) 99876-5432', '(91) 2345-6789'),
(10, 'Fernanda Ferreira', '(85) 98765-4321', '(85) 3456-7890'),
(11, 'Fernando Henrique Collor', '(31) 31313-1313', '(31) 3131-3131');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `id_funcionario` int(11) NOT NULL,
  `nomef` varchar(50) NOT NULL,
  `turno` varchar(20) NOT NULL,
  `salario` decimal(10,2) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `data_contratacao` date NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `cep` varchar(15) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `numero_casa` varchar(10) NOT NULL,
  `foto` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`id_funcionario`, `nomef`, `turno`, `salario`, `tipo`, `data_contratacao`, `cpf`, `email`, `telefone`, `senha`, `cep`, `cidade`, `bairro`, `endereco`, `numero_casa`, `foto`) VALUES
(12, 'Ronaldo Nazário Alves Junior', 'Integral', '0.00', 'Gerente', '2023-04-05', '123.123.123-12', 'ronaldao@gmail.com', '(31) 94329-2349', '$2y$10$STvTVKn1iGVPiZ5j/bdOfOKUlBDe6DltSrD7p5zFNO5nq7HI0QXnO', '76810-441', 'Porto Velho', 'Cidade do Lobo', 'Rua Maldonado', '13', 'Ronaldo Nazário Alves Junior_606132390.jpg'),
(32, 'Cauã Marcos Theo Barbosa', 'Vespertino', '1390.00', 'Cozinheiro', '2023-04-06', '234.405.995-40', 'caua@gmail.com', '(65) 98487-7092', '$2y$10$N3GJ7.8Lz.yWrx6Sr9jgLO6UtSJvdT8U9HvSP0kENEXQpaOLzOAxW', '78051-904', 'Cuiabá', 'Residencial Santa Inês', 'Rua Monte Sinai', '12', 'Cauã Marcos Theo Barbosa_1237920553.png'),
(33, 'Jéssica Nair Teixeira', 'Matutino', '1490.00', 'Cozinheiro', '2023-04-06', '181.883.231-36', 'jessica@gmail.com', '(89) 99713-5935', '$2y$10$rE2xt2WDfLKWQtZYustaYOcDRSD0dES4SygSSFbUeOGSP1Lxz9ccu', '64550-970', 'São Francisco do Piauí', 'Centro', 'Avenida José Rodrigues', '16', 'Jéssica Nair Teixeira_2140604200.png'),
(34, 'Sara Lívia Rocha', 'Vespertino', '1490.00', 'Cozinheiro', '2023-04-06', '558.107.016-47', 'sara@gmail.com', '(79) 99994-3869', '$2y$10$LXS3Z9Qji09mFZO57HRUIOyJSQKIRtCNXQvvm/mW7.CKLU0iXHicC', '49037-456', 'Aracaju', 'Atalaia', 'Travessa Isaac José Rodrigues', '15', 'Sara Lívia Rocha_1749879799.png'),
(35, 'Giovana Rebeca Tatiane Viana', 'Noturno', '2390.00', 'Gerente', '2023-04-06', '927.497.470-15', 'gionana@gmail.com', '(65) 98114-1863', '$2y$10$lB.OKoLqEJXAwrQnmA4q8.w6TRaXAFGq2Xfuf77iC9dr/9u3Gmqs.', '78058-729', 'Cuiabá', 'Novo Mato Grosso', 'Rua Ipiranga', '87', 'Giovana Rebeca Tatiane Viana_1294228874.png'),
(36, 'Vanessa Marlene da Conceição', 'Vespertino', '1390.00', 'Garçom', '2023-04-06', '810.929.533-96', 'vanessa@gmail.com', '(32) 99584-1696', '$2y$10$6jpkx8DlDMa9ZjmrqulYjeEgYY/pMPHz6mRXozVAmo/sief4t39OS', '36204-071', 'Barbacena', 'Santa Efigênia', 'Rua Quatro', '64', 'Vanessa Marlene da Conceição_1923182399.png'),
(37, 'Luiz Yago Fernandes', 'Vespertino', '1390.00', 'Garçom', '2023-04-06', '730.895.231-24', 'luiz@gmail.com', '(91) 99189-7074', '$2y$10$kIk20eHpa8iwt8P5urd7juj1xhHrpJJCt.mjTqQoPQp06aiypBBge', '66825-678', 'Belém', 'Tapanã (Icoaraci)', 'Rua Girassol', '645', 'Luiz Yago Fernandes_1304568480.png'),
(38, 'Fátima Sabrina Cavalcanti', 'Integral', '1990.00', 'Logística', '2023-04-06', '796.768.362-57', 'fatima@gmail.com', '(96) 98453-1814', '$2y$10$EE7IIo1S7m8jnKgzhbx7kO7jCVILy7G6k6hC/vO3Wuovr0EwTlsVC', '68908-240', 'Macapá', 'Pacoval', 'Avenida Maranhão', '67', 'Fátima Sabrina Cavalcanti_53616211.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ticket`
--

CREATE TABLE `ticket` (
  `id_ticket` int(11) NOT NULL,
  `data_criacao` date NOT NULL,
  `data_entrega` date NOT NULL,
  `valor_final` decimal(10,2) NOT NULL,
  `status` varchar(20) NOT NULL,
  `id_funcionario` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `nome_pacote` varchar(70) NOT NULL,
  `observacao` varchar(300) DEFAULT NULL,
  `cidade` varchar(50) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `numero_casa` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `ticket`
--

INSERT INTO `ticket` (`id_ticket`, `data_criacao`, `data_entrega`, `valor_final`, `status`, `id_funcionario`, `id_cliente`, `nome_pacote`, `observacao`, `cidade`, `bairro`, `endereco`, `numero_casa`) VALUES
(26, '2022-01-01', '2022-01-15', '2990.00', 'Concluido', 12, 1, 'Casamento Tradicional', 'Observação A', 'São Paulo', 'Centro', 'Rua A', '100'),
(27, '2022-02-01', '2022-02-20', '5990.90', 'Concluido', 32, 3, 'Casamento Premium', 'Observação B', 'Rio de Janeiro', 'Copacabana', 'Rua B', '200'),
(28, '2022-03-01', '2022-03-25', '5790.90', 'Concluido', 33, 4, 'Festa de Debutante', 'Observação C', 'Belo Horizonte', 'Centro', 'Rua C', '300'),
(29, '2022-04-01', '2022-04-30', '2990.00', 'Em andamento', 34, 5, 'Casamento Tradicional', 'Observação D', 'Curitiba', 'Centro', 'Rua D', '400'),
(30, '2022-05-01', '2022-05-15', '1990.90', 'Em andamento', 35, 6, 'Aniversário Clássico', 'Observação E', 'Porto Alegre', 'Moinhos de Vento', 'Rua E', '500'),
(31, '2022-06-01', '2022-06-30', '5790.90', 'Em andamento', 36, 7, 'Festa de Debutante', 'Observação F', 'Brasília', 'Asa Sul', 'Rua F', '600'),
(32, '2023-03-15', '2023-04-01', '2990.00', 'Concluido', 12, 1, 'Casamento Tradicional', 'Observação do pacote A', 'São Paulo', 'Centro', 'Rua A', '10'),
(33, '2023-02-20', '2023-04-10', '2990.00', 'Em andamento', 32, 3, 'Casamento Tradicional', 'Observação do pacote B', 'Rio de Janeiro', 'Copacabana', 'Rua B', '20'),
(34, '2023-01-10', '2023-03-25', '5990.90', 'Concluido', 33, 4, 'Casamento Premium', 'Observação do pacote C', 'Belo Horizonte', 'Savassi', 'Rua C', '30'),
(35, '2023-03-01', '2023-04-15', '5990.90', 'Em andamento', 34, 5, 'Casamento Premium', 'Observação do pacote D', 'Salvador', 'Barra', 'Rua D', '40'),
(36, '2023-02-05', '2023-03-30', '3990.90', 'Concluido', 35, 6, 'Casamento Intermediário', 'Observação do pacote E', 'Curitiba', 'Centro', 'Rua E', '50'),
(37, '2023-02-15', '2023-04-05', '3990.90', 'Em andamento', 36, 7, 'Casamento Intermediário', 'Observação do pacote F', 'Fortaleza', 'Meireles', 'Rua F', '60'),
(38, '2022-01-01', '2022-01-05', '1990.90', 'Concluido', 12, 1, 'Aniversário Clássico', 'Observação A', 'São Paulo', 'Centro', 'Rua A', '100'),
(39, '2022-02-05', '2022-02-10', '3990.90', 'Concluido', 32, 3, 'Casamento Intermediário', 'Observação B', 'Rio de Janeiro', 'Copacabana', 'Rua B', '200'),
(40, '2022-03-10', '2022-03-15', '3990.90', 'Concluido', 33, 4, 'Casamento Intermediário', 'Observação C', 'Belo Horizonte', 'Savassi', 'Rua C', '300'),
(41, '2022-04-15', '2022-04-20', '1990.90', 'Concluido', 34, 5, 'Aniversário Clássico', 'Observação D', 'Curitiba', 'Centro', 'Rua D', '400'),
(42, '2022-05-20', '2022-05-25', '1990.90', 'Concluido', 35, 6, 'Aniversário Clássico', 'Observação E', 'Recife', 'Boa Viagem', 'Rua E', '500'),
(43, '2022-06-25', '2022-06-30', '1990.90', 'Em andamento', 36, 7, 'Aniversário Clássico', 'Observação F', 'Salvador', 'Pelourinho', 'Rua F', '600'),
(44, '2022-07-30', '2022-08-05', '1990.90', 'Em andamento', 37, 8, 'Aniversário Clássico', 'Observação G', 'Fortaleza', 'Praia do Futuro', 'Rua G', '700');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Índices para tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`id_funcionario`);

--
-- Índices para tabela `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id_ticket`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `id_funcionario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de tabela `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id_ticket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
