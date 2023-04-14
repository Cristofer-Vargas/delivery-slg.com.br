-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 14-Abr-2023 às 00:12
-- Versão do servidor: 5.7.36
-- versão do PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `deliveryslg`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `carrinho`
--

DROP TABLE IF EXISTS `carrinho`;
CREATE TABLE IF NOT EXISTS `carrinho` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_Produto` int(11) NOT NULL,
  `id_Restaurante` int(11) NOT NULL,
  `id_Usuario` int(11) NOT NULL,
  `quantidade` int(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_Produto` (`id_Produto`),
  KEY `id_Restaurante` (`id_Restaurante`),
  KEY `id_Usuario` (`id_Usuario`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `historico_pedidos`
--

DROP TABLE IF EXISTS `historico_pedidos`;
CREATE TABLE IF NOT EXISTS `historico_pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `preco` decimal(10,0) NOT NULL,
  `data_Compra` datetime NOT NULL,
  `id_Restaurante` int(11) NOT NULL,
  `quantidade` int(100) NOT NULL,
  `id_Produto` int(11) NOT NULL,
  `id_Usuario` int(11) NOT NULL,
  `status` set('Em andamento','Pronto','Entregue','Não Entregue') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_Restaurante` (`id_Restaurante`),
  KEY `id_Produto` (`id_Produto`),
  KEY `id_Usuario` (`id_Usuario`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE IF NOT EXISTS `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `descricao` varchar(250) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `categoria` enum('sorvete','pastel','pizza','açai','frango_frito','hamburguer','cachorro_quente','x_burguer') NOT NULL,
  `id_Restaurante` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_Restaurante` (`id_Restaurante`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `restaurantes`
--

DROP TABLE IF EXISTS `restaurantes`;
CREATE TABLE IF NOT EXISTS `restaurantes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `rua` varchar(100) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `complemento` varchar(400) DEFAULT NULL,
  `bairro` varchar(40) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` varchar(11) NOT NULL,
  `cnpj` varchar(14) NOT NULL,
  `hora_Funcionamento` varchar(100) NOT NULL,
  `formas_De_Pagamento` set('dinheiro','cartao_credito','cartao_debito','pix') DEFAULT 'dinheiro' NOT NULL,
  `chave_Pix` varchar(150) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `forma_De_Entrega` set('Retirada no Local','Motoboy') DEFAULT 'Retirada no Local' NOT NULL,
  `ativo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `rua` varchar(100) DEFAULT NULL,
  `num` varchar(10) DEFAULT NULL,
  `comp` varchar(100) DEFAULT NULL,
  `bai` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` varchar(11) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `rua`, `num`, `comp`, `bai`, `email`, `telefone`, `cpf`, `senha`, `imagem`) VALUES
(1, 'Theo Paulo Isaac Oliveira', NULL, NULL, NULL, NULL, 'theopaulooliveira@rodrigofranco.com', '5535530751', '31599151073', '', NULL),
(3, 'Theo Paulo Isaac Oliveira', NULL, NULL, NULL, NULL, 'theo_paulo_oliveira@rodrigofranco.com', '5535530751', '31599151073', 'jrYJolGsLo', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
