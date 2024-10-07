-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07/10/2024 às 21:09
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `lojadeautopecas`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nome`, `email`, `telefone`, `endereco`) VALUES
(15, 'Fernando Aguiar Marques', 'Ferdinando@gmail.com', '98987654321', 'Buriti, Centro'),
(16, 'Marcos Alexandre Gonçalves', 'marcos@gmail.com', '98913245678', 'Avenida Castelo Branco'),
(17, 'Luciano Da Silva Maranhão', 'luciano@gmail.com', '78986754653', 'Bairro Quiabos'),
(20, 'markos rocha', 'markos@gmail.com', '11233445566', 'Bairro Sarney'),
(24, 'Carlos Silva', 'carlos.silva@example.com', '11987654321', 'Rua das Flores, 123'),
(25, 'Maria Oliveira', 'maria.oliveira@example.com', '11976543210', 'Av. Paulista, 456'),
(26, 'João Souza', 'joao.souza@example.com', '11965432109', 'Rua Augusta, 789'),
(27, 'Ana Santos', 'ana.santos@example.com', '11954321098', 'Rua dos Pinheiros, 321'),
(29, 'Bruna Costa', 'bruna.costa@example.com', '11932109876', 'Rua Bela Cintra, 987'),
(30, 'Fernanda Alves', 'fernanda.alves@example.com', '11921098765', 'Rua da Consolação, 432');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pecas`
--

CREATE TABLE `pecas` (
  `id_peca` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL,
  `preco` decimal(10,2) NOT NULL,
  `quantidade_estoque` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pecas`
--

INSERT INTO `pecas` (`id_peca`, `nome`, `descricao`, `preco`, `quantidade_estoque`) VALUES
(10, 'Pneus', 'Pneus de alta performance para veículos de passeio.', 350.00, 96),
(11, 'Pastilhas de Freio', 'Pastilhas de freio dianteiras para automóveis.', 150.00, 100),
(12, 'Óleo de Motor', 'Óleo sintético 5W-30, 1 litro.', 35.00, 300),
(14, 'Filtros de Ar', 'Filtro de ar para motores flex.', 60.00, 146),
(15, 'Radiador', 'Radiador para motores 1.6.', 600.00, 30),
(16, 'Amortecedores', 'Amortecedor dianteiro para carros de passeio.', 300.00, 57),
(17, 'Farois', 'Farol de LED para automóveis.', 250.00, 31);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `data_pedido` datetime NOT NULL,
  `valor_total` decimal(10,2) NOT NULL,
  `id_peca` int(11) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `id_cliente`, `data_pedido`, `valor_total`, `id_peca`, `quantidade`) VALUES
(24, 15, '2024-10-07 00:58:50', 4200.00, 10, 12),
(25, 16, '2024-10-07 01:00:07', 240.00, 14, 4),
(51, 26, '2024-10-07 14:12:24', 1500.00, 16, 5),
(52, 25, '2024-10-07 14:12:48', 2100.00, 10, 6),
(53, 29, '2024-10-07 14:14:12', 900.00, 16, 3);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices de tabela `pecas`
--
ALTER TABLE `pecas`
  ADD PRIMARY KEY (`id_peca`);

--
-- Índices de tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `pecas`
--
ALTER TABLE `pecas`
  MODIFY `id_peca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
