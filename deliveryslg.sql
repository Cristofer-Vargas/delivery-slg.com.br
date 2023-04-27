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

CREATE DATABASE deliveryslg;
USE deliveryslg;

DROP TABLE IF EXISTS `carrinho`;
CREATE TABLE IF NOT EXISTS `carrinho` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_Produto` int(11) NOT NULL,
  `id_Restaurante` int(11) NOT NULL,
  `id_Usuario` int(11) NOT NULL,
  `quantidade` int(100) DEFAULT 1,
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
  `imagem` varchar(255) DEFAULT '/delivery-slg.com.br/assets/images/default-images/lanches-produtos.png',
  `preco` decimal(10,2) NOT NULL,
  `categoria` enum('sorvete','pastel','pizza','açai','frango_frito','hamburguer','cachorro_quente','x_burguer') NOT NULL,
  `id_Restaurante` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_Restaurante` (`id_Restaurante`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
-- --------------------------------------------------------

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `descricao`, `imagem`, `preco`, `categoria`, `id_Restaurante`) VALUES
(39, 'Cachorro Quente Simples', 'Pão, salsicha e molho', '/delivery-slg.com.br/assets/images/default-images/lanches-produtos.png', '6.50', 'cachorro_quente', '1'),
(38, 'Hambúrguer de Picanha', 'Hambúrguer de picanha com queijo', '/delivery-slg.com.br/assets/images/default-images/lanches-produtos.png', '15.50', 'hamburguer', '2'),
(37, 'Frango Frito Crocante', 'Frango frito com crosta crocante', '/delivery-slg.com.br/assets/images/default-images/lanches-produtos.png', '18.99', 'frango_frito', '5'),
(36, 'Açaí com Granola', 'Açaí com granola e frutas', '/delivery-slg.com.br/assets/images/default-images/lanches-produtos.png', '12.99', 'açai', '5'),
(35, 'Pizza de Calabresa', 'Pizza saborosa de calabresa', '/delivery-slg.com.br/assets/images/default-images/lanches-produtos.png', '24.90', 'pizza', '4'),
(34, 'Pastel de Carne', 'Recheado com carne moída', '/delivery-slg.com.br/assets/images/default-images/lanches-produtos.png', '5.99', 'pastel', '3'),
(33, 'Sorvete de Morango', 'Delicioso sorvete de morango', '/delivery-slg.com.br/assets/images/default-images/lanches-produtos.png', '8.50', 'sorvete', '2'),
(25, 'Sorvete de Chocolate', 'Delicioso sorvete de chocolate', '/delivery-slg.com.br/assets/images/default-images/lanches-produtos.png', '12.99', 'sorvete', '1'),
(26, 'Pastel de Queijo', 'Saboroso pastel de queijo', '/delivery-slg.com.br/assets/images/default-images/lanches-produtos.png', '5.50', 'pastel', '1'),
(27, 'Pizza de Calabresa', 'Pizza de calabresa com muito queijo', '/delivery-slg.com.br/assets/images/default-images/lanches-produtos.png', '25.90', 'pizza', '2'),
(28, 'Açai na Tigela', 'Tigela de açai com granola e banana', '/delivery-slg.com.br/assets/images/default-images/lanches-produtos.png', '15.00', 'açai', '4'),
(29, 'Frango Frito', 'Porção de frango frito crocante', '/delivery-slg.com.br/assets/images/default-images/lanches-produtos.png', '18.50', 'frango_frito', '4'),
(30, 'Hamburguer de Carne', 'Hamburguer de carne com queijo e bacon', '/delivery-slg.com.br/assets/images/default-images/lanches-produtos.png', '22.90', 'hamburguer', '2'),
(31, 'Cachorro Quente', 'Cachorro quente com molho de tomate e queijo', '/delivery-slg.com.br/assets/images/default-images/lanches-produtos.png', '8.99', 'cachorro_quente', '5'),
(32, 'X-Burguer', 'Hamburguer de carne com queijo, bacon e salada', '/delivery-slg.com.br/assets/images/default-images/lanches-produtos.png', '27.50', 'x_burguer', '5');
COMMIT;

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
  `complemento` varchar(400),
  `bairro` varchar(40) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` varchar(11) NOT NULL,
  `cnpj` varchar(14) NOT NULL,
  `hora_Funcionamento` varchar(100) NOT NULL,
  `formas_De_Pagamento` set('dinheiro','cartao_credito','cartao_debito','pix') DEFAULT 'dinheiro' NOT NULL,
  `chave_Pix` varchar(150) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `forma_De_Entrega` set('Retirada no Local','Motoboy') DEFAULT 'Retirada no Local' NOT NULL,
  `ativo` tinyint(1),
  `imagem` VARCHAR(255) DEFAULT '/delivery-slg.com.br/assets/images/default-images/restaurante.png' NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
-- --------------------------------------------------------

--
-- Extraindo dados da tabela `restaurantes`
--

INSERT INTO `restaurantes` (`id`, `nome`, `rua`, `numero`, `complemento`, `bairro`, `email`, `telefone`, `cnpj`, `hora_Funcionamento`, `formas_De_Pagamento`, `chave_Pix`, `senha`, `forma_De_Entrega`, `ativo`, `imagem`) VALUES
(1, 'Pizzaria do Zé', 'Rua dos Sabores', '123', 'Loja 1', 'Centro', 'contato@pizzariadoze.com', '11987654321', '12345678900001', 'Seg-Sex: 18:00 - 23:00, Sáb-Dom: 12:00 - 23:00', 'dinheiro,cartao_credito,cartao_debito,pix', 'chavepixpizzariadoze', '123456', 'Motoboy', 1, '/delivery-slg.com.br/assets/images/default-images/restaurante.png'),
(2, 'Burguer House', 'Rua dos Lanches', '456', 'Sala 2', 'Jardim América', 'contato@burguerhouse.com', '11976543210', '23456789000001', 'Seg-Dom: 12:00 - 22:00', 'dinheiro,cartao_credito,cartao_debito', 'chavepixburguerhouse', 'senha123', 'Retirada no Local,Motoboy', 1, '/delivery-slg.com.br/assets/images/default-images/restaurante.png'),
(3, 'Sushi Master', 'Rua dos Peixes', '789', 'Bloco C', 'Jardim Paulista', 'contato@sushimaster.com', '11999999999', '34567890100001', 'Seg-Sex: 18:00 - 23:00, Sáb-Dom: 12:00 - 23:00', 'dinheiro,cartao_credito,pix', 'chavepixsushimaster', 'sushi123', 'Retirada no Local', 1, '/delivery-slg.com.br/assets/images/default-images/restaurante.png'),
(4, 'La Pizzeria', 'Avenida dos Sabores', '321', 'Loja 3', 'Centro', 'contato@lapizzeria.com', '11988888888', '45678901200001', 'Seg-Dom: 18:00 - 23:00', 'dinheiro,cartao_credito,cartao_debito', 'chavepixlapizzeria', 'pizzalover', 'Retirada no Local', 1, '/delivery-slg.com.br/assets/images/default-images/restaurante.png'),
(5, 'Taco Loco', 'Rua dos Tacos', '555', '', 'Pinheiros', 'contato@tacoloco.com', '11977777777', '56789012300001', 'Seg-Sex: 12:00 - 23:00, Sáb-Dom: 12:00 - 22:00', 'dinheiro,cartao_credito,cartao_debito', 'chavepixtacoloco', 'tacolover', 'Retirada no Local,Motoboy', 1, '/delivery-slg.com.br/assets/images/default-images/restaurante.png'),
(6, 'Sabor & Arte', 'Rua dos Chefs', '246', 'Sala 1', 'Vila Olímpia', 'contato@saborearte.com', '11966666666', '67890123400001', 'Seg-Sex: 11:00 - 23:00, Sáb-Dom: 12:00 - 23:00', 'dinheiro,cartao_credito,cartao_debito,pix', 'chavepixsaborearte', 'arte123', 'Motoboy', 1, '/delivery-slg.com.br/assets/images/default-images/restaurante.png');
COMMIT;
-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` varchar(11) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `imagem` varchar(255) DEFAULT '/delivery-slg.com.br/assets/images/default-images/usuario.png',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `rua`, `num`, `comp`, `bai`, `email`, `telefone`, `cpf`, `senha`) VALUES
(1, 'Theo Paulo Isaac Oliveira', NULL, NULL, NULL, NULL, 'theopaulooliveira@rodrigofranco.com', '5535530751', '31599151073', ''),
(3, 'Theo Paulo Isaac Oliveira', NULL, NULL, NULL, NULL, 'theo_paulo_oliveira@rodrigofranco.com', '5535530751', '31599151073', 'jrYJolGsLo'),
(4, 'Ana Silva', 'Rua das Flores', '123', 'Apto 2', 'Centro', 'ana.silva@email.com', '11987654321', '12345678901', 'senha123'),
(5, 'João Santos', 'Avenida Paulista', '456', 'Sala 101', 'Bela Vista', 'joao.santos@email.com', '11998765432', '10987654321', 'senha456'),
(6, 'Maria Souza', 'Rua do Comércio', '789', '', 'Centro', 'maria.souza@email.com', '11987654321', '98765432109', 'senha789');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

--
-- Estrutura da tabela `enderecos`
--

DROP TABLE IF EXISTS `enderecos`;
CREATE TABLE IF NOT EXISTS `enderecos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `rua` varchar(150) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `complemento` varchar(100) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY ('id_usuario') REFERENCES usuarios('id')
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

