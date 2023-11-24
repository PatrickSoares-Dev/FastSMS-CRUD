<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banco de dados</title>
    <!-- Inclua o link para o Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container-xxl flex-grow-1 container-p-y">
<h4 class="fw-semibold py-3 mb-4"><span class="text-muted fw-light">Admin /</span> Banco de dados</h4>    
    <div class="row">
        <div class="col-xl-12">
            <div class="nav-align-top mb-4">
                <ul class="nav nav-pills mb-3" role="tablist">
                    <li class="nav-item">
                        <button
                            type="button"
                            class="nav-link active"
                            role="tab"
                            data-bs-toggle="tab"
                            data-bs-target="#navs-pills-top-home"
                            aria-controls="navs-pills-top-home"
                            aria-selected="true"
                        >
                            Modelo EER
                        </button>
                    </li>
                    <li class="nav-item">
                        <button
                            type="button"
                            class="nav-link"
                            role="tab"
                            data-bs-toggle="tab"
                            data-bs-target="#navs-pills-top-profile"
                            aria-controls="navs-pills-top-profile"
                            aria-selected="false"
                            id="copyDDLButton"
                        >
                            Código da Tabela
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="navs-pills-top-home" role="tabpanel">
                        <div class="row">
                            <div class="col-12">
                                <img src="assets\img\DER.png" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="navs-pills-top-profile" role="tabpanel">
                        <p id="copyStatus"></p>
                        <img src="assets\img\DDLUsuarios.png" class="img-fluid">                  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Inclua os scripts do Bootstrap (jQuery e Popper.js) e do Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.2/dist/js/bootstrap.min.js"></script>

<script>
    const copyButton = document.getElementById('copyDDLButton');

    copyButton.addEventListener('click', () => {
        const ddlCode = `
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
        `;

        const tempTextArea = document.createElement('textarea');
        tempTextArea.value = ddlCode;
        document.body.appendChild(tempTextArea);
        tempTextArea.select();
        document.execCommand('copy');

        document.body.removeChild(tempTextArea);
        document.getElementById('copyStatus').textContent = 'Código DDL copiado para a área de transferência!';
    });
</script>
</body>
</html>
