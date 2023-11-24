-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21/11/2023 às 00:21
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `fastsms`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `logs`
--



--
-- Despejando dados para a tabela `logs`
--

INSERT INTO `logs` (`id`, `email_usuario`, `tipo_acao`, `descricao_log`, `data_log`) VALUES
(10, 'patrick@gmail.com', 'Update', 'Usuário atualizado com sucesso. Campos alterados: nome, estado', '2023-11-20 17:02:46'),
(11, 'patrick@gmail.com', 'UpdateUser', 'Usuário atualizado com sucesso. Campos alterados: nome de \'Costa da Silva Costa\' para \'MARIA Costa da Silva Costa\', estado de \'RJ\' para \'SC\'', '2023-11-20 17:04:42'),
(12, 'patrick@gmail.com', 'UpdateUser', 'Usuário atualizado com sucesso. Campos alterados: estado de \'SC\' para \'RJ\'', '2023-11-20 17:27:38'),
(14, 'patrick@gmail.com', 'UserLoginSuccess', 'Autenticação bem-sucedida.', '2023-11-20 17:44:14'),
(15, 'bruno@example.com', 'UserLoginSuccess', 'Autenticação bem-sucedida.', '2023-11-20 17:44:42'),
(16, 'bruno@example.com', 'UserLoginSuccess', 'Autenticação bem-sucedida. Necessário segundo fator de autenticação.', '2023-11-20 17:45:24'),
(17, 'patrick@gmail.com', 'TwofaSuccess', 'Confirmou segundo fator de autenticação: pergunta escolhida - twofa_mae', '2023-11-20 17:51:24'),
(18, 'patrick@gmail.com', 'TwofaFailed', 'Respostas incorretas nas perguntas de autenticação.', '2023-11-20 17:51:42'),
(19, 'patrick@gmail.com', 'TwofaFailed', 'Respostas incorretas nas perguntas de autenticação.', '2023-11-20 17:52:22'),
(20, 'patrick@gmail.com', 'TwofaFailed', 'Respostas incorretas nas perguntas de autenticação. - twofa_mae', '2023-11-20 17:52:55'),
(21, 'patrick@gmail.com', 'TwofaFailed', 'Respostas incorretas nas perguntas de autenticação. - (twofa_mae)', '2023-11-20 17:53:52'),
(22, 'patrick@gmail.com', 'TwofaFailed', 'Respostas incorretas nas perguntas de autenticação. - (twofa_mae)', '2023-11-20 17:57:48'),
(23, 'patrick@gmail.com', 'TwofaSuccess', 'Confirmou segundo fator de autenticação: pergunta escolhida. - (twofa_mae)', '2023-11-20 17:58:11'),
(24, 'patrick@gmail.com', 'UserLogin', 'O usuário se autenticou no sistema FastSMS - Data de expiração do token: 2023-11-20 18:58:11', '2023-11-20 17:58:11'),
(25, NULL, NULL, NULL, '2023-11-19 11:01:00'),
(26, 'patrick@gmail.com', 'TwofaSuccess', 'Confirmou segundo fator de autenticação: pergunta escolhida. - (twofa_mae)', '2023-11-20 18:02:05');


-- --------------------------------------------------------

--
-- Estrutura para tabela `tokens`
--

CREATE TABLE `tokens` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expiration` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `mae` varchar(255) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `dataNascimento` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `login` varchar(20) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `sexo` varchar(20) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `numeroEndereco` varchar(10) NOT NULL,
  `endereco` text NOT NULL,
  `complemento` varchar(255) NOT NULL,
  `celular` varchar(15) NOT NULL,
  `tipo_user` enum('User','Admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `email_usuario` varchar(255) DEFAULT NULL,
  `tipo_acao` varchar(50) DEFAULT NULL,
  `descricao_log` varchar(255) DEFAULT NULL,
  `data_log` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `mae`, `cpf`, `dataNascimento`, `email`, `login`, `senha`, `tel`, `sexo`, `cep`, `estado`, `cidade`, `numeroEndereco`, `endereco`, `complemento`, `celular`, `tipo_user`) VALUES
(10, 'MARIA Costa da Silva Costa', 'Luzia Soares do Couto', '176.321.007-11', '2005-03-07', 'patrick@gmail.com', 'patrickp', 'patrickp', '(21) 9960-2608', 'Masculino', '23092-060', 'RJ', 'Rio de Janeiro', '9', 'Rua Campina Grande, 09 CA 09', 'Apartamento', '(21) 99602-6088', 'Admin'),
(18, 'Fernando Oliveira', 'Ricardo Oliveira', '111.222.333-44', '1985-10-15', 'fernando@example.com', 'fernando_oliveira', 'hashed_password', '(21) 8765-4321', 'Masculino', '23456-789', 'RJ', 'Niterói', '789', 'Rua da Praia, 789', 'Casa 15', '(21) 3333-3333', 'User');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT de tabela `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
