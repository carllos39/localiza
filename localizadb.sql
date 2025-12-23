-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 23/12/2025 às 13:47
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
-- Banco de dados: `localizadb`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `senha` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`) VALUES
(1, 'Carlos Alexandre', 'carllos3939@gmail.com', '$2y$10$gbUnsubVnrkDdZ8wXsWmwO3wt4CxOIPjABs85SYE70R6CExqqnaSO'),
(2, 'Janete Rosa', 'janeterosa@gmail.com', '$2y$10$SEZPYGaWPiQlGb1QjHoiZunPHAPV52gA7sQSta8gUX/Q8QRNYUst6'),
(4, 'Natalia Cardoso', 'naty@gmail.com', '$2y$10$w447S.3v2yo0CTktIVGsEuQBsnp6E9eAp7Nd7sU7ScPyVeGYnhNpy'),
(5, 'Tiago Cardoso', 'tiago@gmail.com', '$2y$10$VKjU6flDzdZ875jnsNjuY.t7ajRSRhjIk1GwEE2c9CDswEi0AfTgK'),
(6, 'Katia Regina', 'katiaregina@gmail.com', '$2y$10$5CCXMFU2sey6B1TIyy1NCufqj50oIiRhqU6r2IqeRpM2mYLw2h5l.');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
