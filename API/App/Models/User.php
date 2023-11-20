<?php

namespace App\Models;

class User
{
    private static $table = 'usuarios';

    /**
     * Seleciona um usuário com base no ID.
     * @param int $id O ID do usuário.
     * @return array Os dados do usuário.
     * @throws \Exception Se o usuário não for encontrado.
    */
    public static function selectUser(int $id)
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $sql = 'SELECT * FROM ' . self::$table . ' WHERE id = :id';
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } else {
            throw new \Exception("Nenhum usuário encontrado!");
        }
    }

     /**
     * Seleciona todos os usuários.
     * @return array Um array de usuários.
     * @throws \Exception Se nenhum usuário for encontrado.
     */
    public static function selectAllUser()
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $sql = 'SELECT * FROM ' . self::$table;
        $stmt = $connPdo->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } else {
            throw new \Exception("Nenhum usuário encontrado!");
        }
    }


    public static function selectUserByField($field, $value)
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $sql = 'SELECT * FROM ' . self::$table . ' WHERE ' . $field . ' = :value';
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':value', $value);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } else {
            return null;
        }
    }

    public static function insertUser($data)
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $fields = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        $sql = 'INSERT INTO ' . self::$table . ' (' . $fields . ') VALUES (' . $placeholders . ')';
        $stmt = $connPdo->prepare($sql);

        foreach ($data as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }

        if ($stmt->execute()) {
            // Obter o nome do usuário cadastrado
            $userName = $data['nome']; // Supondo que 'nome' é o campo que contém o nome do usuário
            
            // Log de sucesso ao cadastrar usuário com nome
            $logDataSuccess = [
                'email_usuario' => $data['email'], // Adicione o email do usuário cadastrado
                'tipo_acao' => 'InsertUser',
                'descricao_log' => "Usuário $userName cadastrado com sucesso.",
                'data_log' => date('Y-m-d H:i:s'),
            ];

            // Chama o método insertLog da classe User
            self::insertLog($logDataSuccess);

            return 'Usuário cadastrado com sucesso!';
        } else {
            return 'Falha ao cadastrar usuário.';
        }
    }

    /**
     * Atualiza um usuário existente pelo ID e dados fornecidos no corpo JSON.
     * @param array $requestData Os dados da solicitação JSON que contém o ID e os dados a serem atualizados.
     * @return string Uma mensagem de sucesso.
     * @throws \Exception Se a atualização falhar.
     */
    public static function updateUser($id, $data)
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        // Buscar os dados atuais do usuário antes da atualização
        $userDataBeforeUpdate = self::selectUser($id);

        // Construa a consulta SQL para atualizar todos os campos
        $fields = '';
        $fieldsUpdated = [];

        foreach ($data as $key => $value) {
            $fields .= "$key = :$key, ";
            if ($userDataBeforeUpdate[$key] !== $value) {
                $fieldsUpdated[$key] = [
                    'antes' => $userDataBeforeUpdate[$key],
                    'depois' => $value
                ];
            }
        }
        $fields = rtrim($fields, ', ');

        $sql = "UPDATE " . self::$table . " SET $fields WHERE id = :id";
        $stmt = $connPdo->prepare($sql);

        // Vincule os valores
        $stmt->bindValue(':id', $id);
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        if ($stmt->execute()) {       
            // Buscar o email do usuário
            $userData = self::selectUser($id);
            $emailDoUsuario = $userData['email'];

            // Determinar o tipo de ação
            $tipoAcao = 'UpdateUser';

            // Construir detalhes de alterações
            $detalhesAlteracoes = 'Usuário atualizado com sucesso. Campos alterados: ';
            $detalhes = [];
            foreach ($fieldsUpdated as $campo => $valores) {
                $detalhes[] = "$campo de '{$valores['antes']}' para '{$valores['depois']}'";
            }
            $detalhesAlteracoes .= implode(', ', $detalhes);

            // Montar dados do log
            $logData = [
                'email_usuario' => $emailDoUsuario, // Inclui o email no log
                'descricao_log' => $detalhesAlteracoes,                
                'tipo_acao' => $tipoAcao, // Adicionar o tipo de ação ao log
                'data_log' => date('Y-m-d H:i:s'),
            ];

            self::insertLog($logData);
            
            return 'Usuário atualizado com sucesso!';
        } else {

            // Montar dados do log em caso de falha na execução
            $errorDetails = $stmt->errorInfo();
            $errorMessage = "Falha ao executar a atualização do usuário. Detalhes: " . $errorDetails[2];
            $emailDoUsuario = ''; // Defina o email do usuário caso seja relevante aqui

            // Construir dados do log de erro
            $logDataError = [
                'email_usuario' => $emailDoUsuario,
                'descricao_log' => $errorMessage,
                'tipo_acao' => 'ErroUpdateUser',
                'data_log' => date('Y-m-d H:i:s'),
            ];

            self::insertLog($logDataError);
            
            return 'Falha ao atualizar usuário.';
        }
    }
  
    /**
     * Exclui um usuário pelo ID.
     * @param int $id O ID do usuário a ser excluído.
     * @return string Uma mensagem de sucesso.
     * @throws \Exception Se a exclusão falhar.
     */
    public static function deleteUserById(int $id)
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        // Seleciona os detalhes do usuário antes de excluir
        $userDetails = self::selectUser($id);

        $sql = 'DELETE FROM ' . self::$table . ' WHERE id = :id';
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Insere o log do usuário excluído
            $logData = [
                'email_usuario' => $userDetails['email'], // ou qualquer campo identificador
                'tipo_acao' => 'UserDeletion',
                'descricao_log' => "O usuário {$userDetails['nome']} foi excluído do sistema.", // ou outro campo identificador
                'data_log' => date('Y-m-d H:i:s'),
            ];

            self::insertLog($logData);

            return 'Usuário(a) excluído com sucesso!';
        } else {
            throw new \Exception("Falha ao excluir usuário(a)!");
        }
    }
    /**
     * Faz login de um usuário e retorna sucesso ou erro.
     * @param string $login O nome de login ou e-mail do usuário.
     * @param string $senha A senha do usuário.
     * @return string 'Sucesso' se o login for bem-sucedido, 'Erro' se o login falhar.
     */
    public static function userLogin($login, $senha)
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $sql = 'SELECT * FROM ' . self::$table . ' WHERE (login = :login OR email = :email) AND senha = :senha';
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':login', $login);
        $stmt->bindValue(':email', $login); // Adicionar email como opção de login se necessário
        $stmt->bindValue(':senha', $senha);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return 'Sucesso'; // Login bem-sucedido
        } else {
            return 'Erro'; // Login falhou
        }
    }

    public static function selectAllLogs()
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);
    
        $sql = 'SELECT * FROM logs ORDER BY data_log DESC'; // Adicionando a cláusula ORDER BY para ordenar por data_log em ordem decrescente
        $stmt = $connPdo->prepare($sql);
        $stmt->execute();
    
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } else {
            throw new \Exception("Nenhum log encontrado!");
        }
    }

    public static function insertLog($logData)
    {
        // Código existente para conexão ao banco de dados
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        // Inserção de log
        $fields = implode(', ', array_keys($logData));
        $placeholders = ':' . implode(', :', array_keys($logData));
        
        // Modifique para refletir a estrutura da tabela de logs
        $sql = 'INSERT INTO logs (email_usuario, tipo_acao, descricao_log, data_log) VALUES (:email_usuario, :tipo_acao, :descricao_log, :data_log)';
        
        $stmt = $connPdo->prepare($sql);

        // Vincule os valores aos placeholders
        $stmt->bindValue(':email_usuario', $logData['email_usuario']);
        $stmt->bindValue(':tipo_acao', $logData['tipo_acao']);
        $stmt->bindValue(':descricao_log', $logData['descricao_log']);
        $stmt->bindValue(':data_log', $logData['data_log']);

        $stmt->execute();
    }

    public static function deleteLogById(int $id)
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $sql = 'DELETE FROM logs WHERE id = :id';
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $logData = [
                'email_usuario' => 'Admin', // ou qualquer campo identificador
                'tipo_acao' => 'DeleteLog',
                'descricao_log' => "O log $id foi excluido dos registros.", // ou outro campo identificador
                'data_log' => date('Y-m-d H:i:s'),
            ];

            self::insertLog($logData);
            return 'Log excluído com sucesso!';
        } else {
            throw new \Exception("Falha ao excluir o log!");
        }
    }

}
?>

