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

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `email_usuario` varchar(255) DEFAULT NULL,
  `tipo_acao` varchar(50) DEFAULT NULL,
  `descricao_log` varchar(255) DEFAULT NULL,
  `data_log` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(26, 'patrick@gmail.com', 'TwofaSuccess', 'Confirmou segundo fator de autenticação: pergunta escolhida. - (twofa_mae)', '2023-11-20 18:02:05'),
(27, 'patrick@gmail.com', 'UserLogin', 'O usuário se autenticou no sistema FastSMS - Data de expiração do token: 2023-11-20 19:02:05', '2023-11-20 18:02:05'),
(28, 'patrick@gmail.com', 'TwofaSuccess', 'Confirmou segundo fator de autenticação: pergunta escolhida. - (twofa_mae)', '0000-00-00 00:00:00'),
(29, 'patrick@gmail.com', 'UserLogin', 'O usuário se autenticou no sistema FastSMS - Data de expiração do token: 2023-11-20 19:10:31', '0000-00-00 00:00:00'),
(30, 'patrick@gmail.com', 'TwofaSuccess', 'Confirmou segundo fator de autenticação: pergunta escolhida. - (twofa_mae)', '0000-00-00 00:00:00'),
(31, 'patrick@gmail.com', 'UserLogin', 'O usuário se autenticou no sistema FastSMS - Data de expiração do token: 2023-11-20 19:11:43', '0000-00-00 00:00:00'),
(32, 'patrick@gmail.com', 'TwofaSuccess', 'Confirmou segundo fator de autenticação: pergunta escolhida. - (twofa_mae)', '0000-00-00 00:00:00'),
(33, 'patrick@gmail.com', 'UserLogin', 'O usuário se autenticou no sistema FastSMS - Data de expiração do token: 2023-11-20 19:12:20', '0000-00-00 00:00:00'),
(34, 'patrick@gmail.com', 'TwofaSuccess', 'Confirmou segundo fator de autenticação: pergunta escolhida. - (twofa_mae)', '0000-00-00 00:00:00'),
(35, 'patrick@gmail.com', 'UserLogin', 'O usuário se autenticou no sistema FastSMS - Data de expiração do token: 2023-11-20 19:13:36', '0000-00-00 00:00:00'),
(36, 'patrick@gmail.com', 'TwofaSuccess', 'Confirmou segundo fator de autenticação: pergunta escolhida. - (twofa_mae)', '2023-11-20 18:14:12'),
(37, 'patrick@gmail.com', 'UserLogin', 'O usuário se autenticou no sistema FastSMS - Data de expiração do token: 2023-11-20 19:14:12', '0000-00-00 00:00:00'),
(38, 'patrick@gmail.com', 'TwofaSuccess', 'Confirmou segundo fator de autenticação: pergunta escolhida. - (twofa_mae)', '2023-11-20 18:14:39'),
(39, 'patrick@gmail.com', 'UserLogin', 'O usuário se autenticou no sistema FastSMS - Data de expiração do token: 2023-11-20 19:14:39', '2023-11-20 18:14:39'),
(40, 'laura@example.com', 'UserDeletion', 'O usuário Laura Silva foi excluído do sistema.', '2023-11-20 18:17:42'),
(41, 'patrick@gmail.com', 'UserLoginSuccess', 'Autenticação bem-sucedida. Necessário segundo fator de autenticação.', '2023-11-20 18:33:00'),
(42, 'patrick@gmail.com', 'UserLoginSuccess', 'Autenticação bem-sucedida. Necessário segundo fator de autenticação.', '2023-11-20 18:33:24'),
(43, 'patrick@gmail.com', 'UserLoginSuccess', 'Autenticação bem-sucedida. Necessário segundo fator de autenticação.', '2023-11-20 18:34:23'),
(44, 'patrick@gmail.com', 'TwofaSuccess', 'Confirmou segundo fator de autenticação: pergunta escolhida. - (twofa_mae)', '2023-11-20 18:35:17'),
(45, 'patrick@gmail.com', 'UserLogin', 'O usuário se autenticou no sistema FastSMS - Data de expiração do token: 2023-11-20 19:35:17', '2023-11-20 18:35:17'),
(46, 'tesox@mailinator.com', 'UserDeletion', 'O usuário Garydasdsadsadsadsa foi excluído do sistema.', '2023-11-20 18:35:42'),
(47, 'diego@example.com', 'UpdateUser', 'Usuário atualizado com sucesso. Campos alterados: cidade de \'São Paulo\' para \'Rio de Janeiro\'', '2023-11-20 18:36:06'),
(48, 'diego@example.com', 'UpdateUser', 'Usuário atualizado com sucesso. Campos alterados: login de \'diego_souza\' para \'diego_souza2\', cidade de \'Rio de Janeiro\' para \'São Paulo\'', '2023-11-20 18:36:06'),
(49, 'diego@example.com', 'UpdateUser', 'Usuário atualizado com sucesso. Campos alterados: cidade de \'São Paulo\' para \'Santa Catarina\'', '2023-11-20 18:36:39'),
(50, 'bylug@mailinator.com', 'InsertUser', 'Usuário Lesley DASDASDASDAS cadastrado com sucesso.', '2023-11-20 18:42:00'),
(51, 'patrick@gmail.com', 'UserLoginSuccess', 'Autenticação bem-sucedida. Necessário segundo fator de autenticação.', '2023-11-20 19:42:20'),
(52, 'patrick@gmail.com', 'TwofaSuccess', 'Confirmou segundo fator de autenticação: pergunta escolhida. - (twofa_mae)', '2023-11-20 19:42:25'),
(53, 'patrick@gmail.com', 'UserLogin', 'O usuário se autenticou no sistema FastSMS - Data de expiração do token: 2023-11-20 20:42:25', '2023-11-20 19:42:25'),
(54, 'Admin', 'DeleteLog', 'O log 3 foi excluido dos registros.', '2023-11-20 20:17:04'),
(55, 'patrick@gmail.com', 'UserLoginSuccess', 'Autenticação bem-sucedida. Necessário segundo fator de autenticação.', '2023-11-20 20:45:42'),
(56, 'patrick@gmail.com', 'TwofaSuccess', 'Confirmou segundo fator de autenticação: pergunta escolhida. - (twofa_mae)', '2023-11-20 20:45:48'),
(57, 'patrick@gmail.com', 'UserLogin', 'O usuário se autenticou no sistema FastSMS - Data de expiração do token: 2023-11-20 21:45:48', '2023-11-20 20:45:48'),
(58, 'patrick@gmail.com', 'UserLoginSuccess', 'Autenticação bem-sucedida. Necessário segundo fator de autenticação.', '2023-11-20 21:46:19'),
(59, 'patrick@gmail.com', 'TwofaSuccess', 'Confirmou segundo fator de autenticação: pergunta escolhida. - (twofa_data)', '2023-11-20 21:46:30'),
(60, 'patrick@gmail.com', 'UserLogin', 'O usuário se autenticou no sistema FastSMS - Data de expiração do token: 2023-11-20 22:46:30', '2023-11-20 21:46:30'),
(61, 'bylug@mailinator.com', 'UpdateUser', 'Usuário atualizado com sucesso. Campos alterados: endereco de \'Ipsum animi veniam\' para \'Ipsum animi dasdsa\'', '2023-11-20 21:51:29'),
(62, 'patrick@gmail.com', 'UpdateUser', 'Usuário atualizado com sucesso. Campos alterados: endereco de \'Rua Campina Grande, 09 CA 09\nCasa\' para \'Rua Campina Grande, 09 CA 09\'', '2023-11-20 21:55:06'),
(63, 'patrick@gmail.com', 'UpdateUser', 'Usuário atualizado com sucesso. Campos alterados: endereco de \'Rua Campina Grande, 09 CA 09\' para \'Rua Campina Grande, 09 CA 09 A\'', '2023-11-20 21:55:34'),
(64, 'patrick@gmail.com', 'UpdateUser', 'Usuário atualizado com sucesso. Campos alterados: endereco de \'Rua Campina Grande, 09 CA 09 A\' para \'Rua Campina Grande, 09 CA 09\'', '2023-11-20 22:00:20'),
(65, 'bylug@mailinator.com', 'UserDeletion', 'O usuário Lesley DASDASDASDAS foi excluído do sistema.', '2023-11-20 22:06:43'),
(66, 'diego@example.com', 'UserDeletion', 'O usuário Diego Souza foi excluído do sistema.', '2023-11-20 22:07:23'),
(67, 'vanessa@example.com', 'UserDeletion', 'O usuário Vanessa Santos foi excluído do sistema.', '2023-11-20 22:09:00'),
(68, 'Admin', 'DeleteLog', 'O log 6 foi excluido dos registros.', '2023-11-20 22:14:20'),
(69, 'Admin', 'DeleteLog', 'O log 4 foi excluido dos registros.', '2023-11-20 22:17:45'),
(70, 'Admin', 'DeleteLog', 'O log 5 foi excluido dos registros.', '2023-11-20 22:17:57'),
(71, 'Admin', 'DeleteLog', 'O log 8 foi excluido dos registros.', '2023-11-20 22:18:03'),
(72, 'Admin', 'DeleteLog', 'O log 7 foi excluido dos registros.', '2023-11-20 22:18:12'),
(73, 'Admin', 'DeleteLog', 'O log 9 foi excluido dos registros.', '2023-11-20 22:18:15'),
(74, 'Admin', 'DeleteLog', 'O log 13 foi excluido dos registros.', '2023-11-20 22:18:19'),
(75, 'patrick@gmail.com', 'UpdateUser', 'Usuário atualizado com sucesso. Campos alterados: senha de \'hashed_password\' para \'PatrickTeste\'', '2023-11-20 22:52:09'),
(76, 'patrick@gmail.com', 'UpdateUser', 'Usuário atualizado com sucesso. Campos alterados: senha de \'PatrickTeste\' para \'PatrickTeste2\'', '2023-11-20 22:53:39'),
(77, 'patrick@gmail.com', 'UpdateUser', 'Usuário atualizado com sucesso. Campos alterados: senha de \'PatrickTeste2\' para \'PatrickTeste1\'', '2023-11-20 22:54:19'),
(78, 'patrick@gmail.com', 'ForgotPasswordSucess', 'O usuário patrick@gmail.com alterou a senha,', '2023-11-20 22:54:19'),
(79, 'patrick@gmail.com', 'ForgotPasswordSucess', 'O usuário patrick@gmail.com solicitou a alteração de senha e acertou a pergunta de segurança.', '2023-11-20 23:18:44'),
(80, 'patrick@gmail.com', 'ForgotPasswordSucess', 'O usuário patrick@gmail.com solicitou a alteração de senha e acertou a pergunta de segurança.', '2023-11-20 23:21:07'),
(81, 'patrick@gmail.com', 'ForgotPasswordSucess', 'O usuário patrick@gmail.com solicitou a alteração de senha e acertou a pergunta de segurança.', '2023-11-20 23:26:06'),
(82, 'patrick@gmail.com', 'UpdateUser', 'Usuário atualizado com sucesso. Campos alterados: senha de \'PatrickTeste1\' para \'22demaio\'', '2023-11-20 23:26:12'),
(83, 'patrick@gmail.com', 'ForgotPasswordSucess', 'O usuário patrick@gmail.com alterou a senha.', '2023-11-20 23:26:12'),
(84, 'patrick@gmail.com', 'ForgotPasswordSucess', 'O usuário patrick@gmail.com solicitou a alteração de senha e acertou a pergunta de segurança.', '2023-11-20 23:51:22'),
(85, 'patrick@gmail.com', 'ForgotPasswordSucess', 'O usuário patrick@gmail.com solicitou a alteração de senha e acertou a pergunta de segurança.', '2023-11-20 23:58:03'),
(86, 'patrick@gmail.com', 'UpdateUser', 'Usuário atualizado com sucesso. Campos alterados: senha de \'22demaio\' para \'patrickp\'', '2023-11-20 23:58:12'),
(87, 'patrick@gmail.com', 'ForgotPasswordSucess', 'O usuário patrick@gmail.com alterou a senha.', '2023-11-20 23:58:12'),
(88, 'patrick@gmail.com', 'UserLoginSuccess', 'Autenticação bem-sucedida. Necessário segundo fator de autenticação.', '2023-11-21 00:01:30'),
(89, 'patrick@gmail.com', 'TwofaFailed', 'Respostas incorretas nas perguntas de autenticação. - (twofa_data)', '2023-11-21 00:01:40'),
(90, 'patrick@gmail.com', 'TwofaSuccess', 'Confirmou segundo fator de autenticação: pergunta escolhida. - (twofa_data)', '2023-11-21 00:01:42'),
(91, 'patrick@gmail.com', 'UserLogin', 'O usuário se autenticou no sistema FastSMS - Data de expiração do token: 2023-11-21 01:01:42', '2023-11-21 00:01:42');

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

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `mae`, `cpf`, `dataNascimento`, `email`, `login`, `senha`, `tel`, `sexo`, `cep`, `estado`, `cidade`, `numeroEndereco`, `endereco`, `complemento`, `celular`, `tipo_user`) VALUES
(10, 'MARIA Costa da Silva Costa', 'Luzia Soares do Couto', '176.321.007-11', '2005-03-07', 'patrick@gmail.com', 'patrickp', 'patrickp', '(21) 9960-2608', 'Masculino', '23092-060', 'RJ', 'Rio de Janeiro', '9', 'Rua Campina Grande, 09 CA 09', 'Apartamento', '(21) 99602-6088', 'Admin'),
(18, 'Fernando Oliveira', 'Ricardo Oliveira', '111.222.333-44', '1985-10-15', 'fernando@example.com', 'fernando_oliveira', 'hashed_password', '(21) 8765-4321', 'Masculino', '23456-789', 'RJ', 'Niterói', '789', 'Rua da Praia, 789', 'Casa 15', '(21) 3333-3333', 'User'),
(20, 'Ricardo Silva', 'Carlos Silva', '555.444.333-22', '1980-01-05', 'ricardo@example.com', 'ricardo_silva', 'hashed_password', '(41) 1234-5678', 'Masculino', '98765-432', 'PR', 'Curitiba', '888', 'Avenida Teste, 888', 'Bloco C', '(41) 7654-3210', 'User'),
(21, 'Sara Almeida', 'Ana Almeida', '444.555.666-77', '1989-09-20', 'sara@example.com', 'sara_almeida', 'hashed_password', '(85) 8888-9999', 'Feminino', '65432-109', 'CE', 'Fortaleza', '1010', 'Rua dos Testes, 1010', 'Casa 25', '(85) 9999-8888', 'User'),
(22, 'Bruno Oliveira', 'Marcos Oliveira', '888.999.000-11', '1978-07-30', 'bruno@example.com', 'bruno_oliveira', 'hashed_password', '(61) 2345-6789', 'Masculino', '12345-678', 'DF', 'Brasília', '1212', 'Rua das Esquinas, 1212', 'Apto 15', '(61) 9876-5432', 'User');

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
