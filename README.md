<a href="">
    <img src="./src/assets/img/Logo.png" alt="FastSMS" title="FastSMS" align="right" height="60" />
</a>

# FastSMS API - Guia de Instalação e Uso

[![Postman](https://img.shields.io/badge/Postman-Test%20Endpoints-orange.svg)](https://www.postman.com/)
[![PHP](https://img.shields.io/badge/PHP-7.0%20or%20later-blue.svg)](https://www.php.net/)
[![Composer](https://img.shields.io/badge/Composer-Dependency%20Manager-purple.svg)](https://getcomposer.org/)

## Introdução

Bem-vindo ao guia de instalação e uso da API FastSMS. Este guia fornecerá informações sobre como configurar e usar a API para interagir com os usuários. Certifique-se de seguir os passos abaixo para uma configuração adequada.

## Requisitos

Antes de começar, verifique se você possui os seguintes requisitos instalados:

- [PHP](https://www.php.net/) (versão 7.0 ou posterior)
- [Composer](https://getcomposer.org/)
- [Postman](https://www.postman.com/) (para testar os endpoints da API)


## OBRIGATÓRIO A CADA NOVO CLONE DO PROJETO
```
 Você deve executar os comandos do Composer no diretório raiz do projeto. /FastSMS

Execute:

Remove-Item -Recurse -Force vendor
composer install

```

## Banco de dados

1. Abra o arquivo `.config.php` no diretório do API do projeto.

2. Localize as configurações de banco de dados no arquivo `.config.php`. Elas devem se parecer com isto:

   ```plaintext
    //Mysql
    const DBDRIVE = 'mysql';
    const DBHOST = 'localhost';
    const DBNAME = 'fastsms';
    const DBUSER = 'root';
    const DBPASS = '';

## Cria a tabela de usuários
```sql
-- Criação da tabela de usuários
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    mae VARCHAR(255) NOT NULL,
    cpf VARCHAR(14) NOT NULL,
    dataNascimento DATE NOT NULL,
    tel VARCHAR(14) NOT NULL,
    sexo CHAR(1) NOT NULL,
    cep VARCHAR(10) NOT NULL,
    estado VARCHAR(2) NOT NULL,
    cidade VARCHAR(255) NOT NULL,
    numeroEndereco VARCHAR(10) NOT NULL,
    endereco VARCHAR(255) NOT NULL,
    complemento VARCHAR(255),
    email VARCHAR(255) NOT NULL,
    login VARCHAR(255) NOT NULL,
    celular VARCHAR(15) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    tipo_user VARCHAR(255) NOT NULL
);

-- Inserção de registros na tabela
INSERT INTO usuarios (nome, mae, cpf, dataNascimento, tel, sexo, cep, estado, cidade, numeroEndereco, endereco, complemento, email, celular, senha, tipo_user, login)
VALUES
    ('Admin', 'Mãe Admin', '111.222.333-44', '1980-12-10', '(31) 7777-7777', 'M', '12345-678', 'MG', 'Belo Horizonte', '789', 'Rua Central, 789', 'Bloco B', 'admin@example.com', '(31) 7777-7777', 'senhaAdmin', 'admin', 'admin'),
    ('Usuário 2', 'Mãe 2', '987.654.321-09', '1985-05-20', '(21) 5555-5555', 'F', '54321-876', 'RJ', 'Rio de Janeiro', '456', 'Avenida Principal, 456', '', 'usuario2@example.com', '(21) 5555-5555', 'senha456', 'usuário', 'usuario2'),
    ('Usuário 1', 'Mãe 1', '123.456.789-01', '1990-01-15', '(11) 98765-4321', 'M', '12345-678', 'SP', 'São Paulo', '123', 'Rua das Flores, 123', 'Apto 101', 'usuario1@example.com', '(11) 98765-4321', 'senha123', 'usuário', 'usuario1'),
    ('Patrick Soares de Oliveira', 'Maria da Silva Costa', '176.321.007-33', '2003-03-07', '(21) 9996-0260', 'Masculino', '23092-060', 'RJ', 'Rio de Janeiro', '09', 'BR-RJ Telecall Bloco 01 5 ANDAR', 'TEste', 'xuzonemo@mailinator.com', '(21) 99602-6088', '22Demaio@', 'usuário', 'patrick_oliveira');

```



## Endpoints da API

A API FastSMS fornece os seguintes endpoints para interagir com os usuários:

### 1. Obter todos os usuários

- **Método:** GET
- **URL:** [http://localhost/FastSMS/API/public_html/api/user/getUser](http://localhost/FastSMS/API/public_html/api/user/getUser)

### 2. Obter um usuário por ID

- **Método:** GET
- **URL:** [http://localhost/FastSMS/API/public_html/api/user/getUser/{id}](http://localhost/FastSMS/API/public_html/api/user/getUser/{id})
- **Substitua {id} pelo ID do usuário que você deseja recuperar.**

### 3. Registrar um novo usuário

- **Método:** POST
- **URL:** [http://localhost/FastSMS/API/public_html/api/user/registerNewUser](http://localhost/FastSMS/API/public_html/api/user/registerNewUser)
- **Corpo da solicitação (JSON):** Forneça os dados do usuário a serem registrados no corpo da solicitação. Consulte o exemplo no código-fonte.

```json
{
    "nome": "Nome do Novo Usuário",
    "data_nascimento": "1990-01-15",
    "sexo": "M",
    "nome_materno": "Mãe do Novo Usuário",
    "cpf": "123.456.789-01",
    "celular": "(11) 98765-4321",
    "cep": "12345-678",
    "endereco": "Rua das Flores, 123",
    "cidade": "São Paulo",
    "estado": "SP",
    "login": "novousuario",
    "senha": "senhadonovousuario",
    "email": "novousuario@example.com"
}
```

### 4. Atualizar um usuário por ID

- **Método:** PUT
- **URL:** [http://localhost/FastSMS/API/public_html/api/user/updateUserById](http://localhost/FastSMS/API/public_html/api/user/updateUserById)
- **Corpo da solicitação (JSON):** Forneça os dados do usuário a serem registrados no corpo da solicitação. Consulte o exemplo no código-fonte.

````json
{
    "id": 1,
    "data": {
        "nome": "Novo Nome do Usuário",
        "cpf": "987.654.321-09",
        "email": "novonome@example.com"
    }
}
````

### 5. Excluir um usuário por ID

- **Método:** DELETE
- **URL:** [http://localhost/FastSMS/API/public_html/api/user/deleteUserById/{id}](http://localhost/FastSMS/API/public_html/api/user/deleteUserById/{id})
- **Substitua {id} pelo ID do usuário que você deseja excluir.

### 6. Fazer login de um usuário

- **Método:** POST
- **URL:** [http://localhost/FastSMS/API/public_html/api/user/userLogin](http://localhost/FastSMS/API/public_html/api/user/userLogin)
- **Corpo da solicitação (JSON): Forneça o nome de login ou e-mail do usuário e a senha no corpo da solicitação. Consulte o exemplo no código-fonte.

```json

{
    "login": "usuarioteste",
    "senha": "senhateste"
}

```

