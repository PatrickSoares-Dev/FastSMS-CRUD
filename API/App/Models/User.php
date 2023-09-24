<<<<<<< HEAD
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

    /**
     * Registra um novo usuário.
     * @param array $data Os dados do usuário a serem registrados.
     * @return string Uma mensagem de sucesso.
     * @throws \Exception Se a inserção falhar.
     */
    public static function registerNewUser($data)
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        // Verifica se já existe um usuário com o mesmo login ou email
        $checkUserQuery = 'SELECT * FROM ' . self::$table . ' WHERE login = :login OR email = :email';
        $stmtCheckUser = $connPdo->prepare($checkUserQuery);
        $stmtCheckUser->bindValue(':login', $data['login']);
        $stmtCheckUser->bindValue(':email', $data['email']); // Supondo que o email seja fornecido no array $data
        $stmtCheckUser->execute();

        if ($stmtCheckUser->rowCount() > 0) {
            // Retorna todos os campos duplicados de dados sensíveis
            $duplicates = [];
            while ($row = $stmtCheckUser->fetch(\PDO::FETCH_ASSOC)) {
                $duplicate = [
                    'cpf' => $row['cpf'],
                    'celular' => $row['celular'],
                    'login' => $row['login'],
                    'email' => $row['email']
                ];
                $duplicates[] = $duplicate;
            }
        
            // Define o código de status HTTP 409 Conflict e retorna os detalhes das duplicatas
            http_response_code(409);
            return [
                'status' => '409', // Alterado para retornar o código de status diretamente
                'message' => 'Itens duplicados',
                'data' => $duplicates
            ];               
        } else {
            // Se não houver duplicatas, prossiga com a inserção do usuário
            $insertUserQuery = 'INSERT INTO ' . self::$table . ' (nome, data_nascimento, sexo, nome_materno, cpf, celular, telefone_fixo, cep, endereco, cidade, estado, login, senha, tipo_user, email) VALUES (:nome, :data_nascimento, :sexo, :nome_materno, :cpf, :celular, :telefone_fixo, :cep, :endereco, :cidade, :estado, :login, :senha, :tipo_user, :email)';
            $stmtInsertUser = $connPdo->prepare($insertUserQuery);
            $stmtInsertUser->bindValue(':nome', $data['nome']);
            $stmtInsertUser->bindValue(':data_nascimento', $data['data_nascimento']);
            $stmtInsertUser->bindValue(':sexo', $data['sexo']);
            $stmtInsertUser->bindValue(':nome_materno', $data['nome_materno']);
            $stmtInsertUser->bindValue(':cpf', $data['cpf']);
            $stmtInsertUser->bindValue(':celular', $data['celular']);
            $stmtInsertUser->bindValue(':telefone_fixo', $data['telefone_fixo']);
            $stmtInsertUser->bindValue(':cep', $data['cep']);
            $stmtInsertUser->bindValue(':endereco', $data['endereco']);
            $stmtInsertUser->bindValue(':cidade', $data['cidade']);
            $stmtInsertUser->bindValue(':estado', $data['estado']);
            $stmtInsertUser->bindValue(':login', $data['login']);
            $stmtInsertUser->bindValue(':senha', $data['senha']);
            $stmtInsertUser->bindValue(':tipo_user', 'User'); // Definindo 'User' como valor padrão para tipo_user
            $stmtInsertUser->bindValue(':email', $data['email']);
            $stmtInsertUser->execute();

            if ($stmtInsertUser->rowCount() > 0) {
                return 'Usuário(a) inserido com sucesso!';
            } else {
                throw new \Exception("Falha ao inserir usuário(a)!");
            }
        }
    }

    /**
     * Atualiza um usuário existente pelo ID e dados fornecidos no corpo JSON.
     * @param array $requestData Os dados da solicitação JSON que contém o ID e os dados a serem atualizados.
     * @return string Uma mensagem de sucesso.
     * @throws \Exception Se a atualização falhar.
     */
    public static function updateUserById($requestData)
    {
        if (!isset($requestData['id']) || !isset($requestData['data'])) {
            throw new \Exception("Dados incompletos na solicitação.");
        }

        $id = $requestData['id'];
        $data = $requestData['data'];

        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $fieldsToUpdate = array_keys($data);
        $validFields = ['nome', 'data_nascimento', 'sexo', 'nome_materno', 'cpf', 'celular', 'telefone_fixo', 'cep', 'endereco', 'cidade', 'estado', 'login', 'senha', 'tipo_user'];

        // Filtra apenas os campos válidos fornecidos nos dados de entrada
        $fieldsToUpdate = array_intersect($fieldsToUpdate, $validFields);

        if (empty($fieldsToUpdate)) {
            throw new \Exception("Nenhum campo válido para atualização fornecido!");
        }

        $sql = 'UPDATE ' . self::$table . ' SET ';
        foreach ($fieldsToUpdate as $field) {
            $sql .= $field . ' = :' . $field . ', ';
        }
        $sql = rtrim($sql, ', ') . ' WHERE id = :id';

        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':id', $id);

        // Bind dos valores dos campos a serem atualizados
        foreach ($fieldsToUpdate as $field) {
            $stmt->bindValue(':' . $field, $data[$field]);
        }

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return 'Usuário(a) atualizado com sucesso!';
        } else {
            throw new \Exception("Falha ao atualizar usuário(a)!");
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

        $sql = 'DELETE FROM ' . self::$table . ' WHERE id = :id';
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
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
}
?>
=======
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

    /**
     * Registra um novo usuário.
     * @param array $data Os dados do usuário a serem registrados.
     * @return string Uma mensagem de sucesso.
     * @throws \Exception Se a inserção falhar.
     */
    public static function registerNewUser($data)
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        // Verifica se já existe um usuário com o mesmo login ou email
        $checkUserQuery = 'SELECT * FROM ' . self::$table . ' WHERE login = :login OR email = :email';
        $stmtCheckUser = $connPdo->prepare($checkUserQuery);
        $stmtCheckUser->bindValue(':login', $data['login']);
        $stmtCheckUser->bindValue(':email', $data['email']); // Supondo que o email seja fornecido no array $data
        $stmtCheckUser->execute();

        if ($stmtCheckUser->rowCount() > 0) {
            // Retorna todos os campos duplicados de dados sensíveis
            $duplicates = [];
            while ($row = $stmtCheckUser->fetch(\PDO::FETCH_ASSOC)) {
                $duplicate = [
                    'cpf' => $row['cpf'],
                    'celular' => $row['celular'],
                    'login' => $row['login'],
                    'email' => $row['email']
                ];
                $duplicates[] = $duplicate;
            }
        
            // Define o código de status HTTP 409 Conflict e retorna os detalhes das duplicatas
            http_response_code(409);
            return [
                'status' => '409', // Alterado para retornar o código de status diretamente
                'message' => 'Itens duplicados',
                'data' => $duplicates
            ];               
        } else {
            // Se não houver duplicatas, prossiga com a inserção do usuário
            $insertUserQuery = 'INSERT INTO ' . self::$table . ' (nome, data_nascimento, sexo, nome_materno, cpf, celular, telefone_fixo, cep, endereco, cidade, estado, login, senha, tipo_user, email) VALUES (:nome, :data_nascimento, :sexo, :nome_materno, :cpf, :celular, :telefone_fixo, :cep, :endereco, :cidade, :estado, :login, :senha, :tipo_user, :email)';
            $stmtInsertUser = $connPdo->prepare($insertUserQuery);
            $stmtInsertUser->bindValue(':nome', $data['nome']);
            $stmtInsertUser->bindValue(':data_nascimento', $data['data_nascimento']);
            $stmtInsertUser->bindValue(':sexo', $data['sexo']);
            $stmtInsertUser->bindValue(':nome_materno', $data['nome_materno']);
            $stmtInsertUser->bindValue(':cpf', $data['cpf']);
            $stmtInsertUser->bindValue(':celular', $data['celular']);
            $stmtInsertUser->bindValue(':telefone_fixo', $data['telefone_fixo']);
            $stmtInsertUser->bindValue(':cep', $data['cep']);
            $stmtInsertUser->bindValue(':endereco', $data['endereco']);
            $stmtInsertUser->bindValue(':cidade', $data['cidade']);
            $stmtInsertUser->bindValue(':estado', $data['estado']);
            $stmtInsertUser->bindValue(':login', $data['login']);
            $stmtInsertUser->bindValue(':senha', $data['senha']);
            $stmtInsertUser->bindValue(':tipo_user', 'User'); // Definindo 'User' como valor padrão para tipo_user
            $stmtInsertUser->bindValue(':email', $data['email']);
            $stmtInsertUser->execute();

            if ($stmtInsertUser->rowCount() > 0) {
                return 'Usuário(a) inserido com sucesso!';
            } else {
                throw new \Exception("Falha ao inserir usuário(a)!");
            }
        }
    }

    /**
     * Atualiza um usuário existente pelo ID e dados fornecidos no corpo JSON.
     * @param array $requestData Os dados da solicitação JSON que contém o ID e os dados a serem atualizados.
     * @return string Uma mensagem de sucesso.
     * @throws \Exception Se a atualização falhar.
     */
    public static function updateUserById($requestData)
    {
        if (!isset($requestData['id']) || !isset($requestData['data'])) {
            throw new \Exception("Dados incompletos na solicitação.");
        }

        $id = $requestData['id'];
        $data = $requestData['data'];

        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $fieldsToUpdate = array_keys($data);
        $validFields = ['nome', 'data_nascimento', 'sexo', 'nome_materno', 'cpf', 'celular', 'telefone_fixo', 'cep', 'endereco', 'cidade', 'estado', 'login', 'senha', 'tipo_user'];

        // Filtra apenas os campos válidos fornecidos nos dados de entrada
        $fieldsToUpdate = array_intersect($fieldsToUpdate, $validFields);

        if (empty($fieldsToUpdate)) {
            throw new \Exception("Nenhum campo válido para atualização fornecido!");
        }

        $sql = 'UPDATE ' . self::$table . ' SET ';
        foreach ($fieldsToUpdate as $field) {
            $sql .= $field . ' = :' . $field . ', ';
        }
        $sql = rtrim($sql, ', ') . ' WHERE id = :id';

        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':id', $id);

        // Bind dos valores dos campos a serem atualizados
        foreach ($fieldsToUpdate as $field) {
            $stmt->bindValue(':' . $field, $data[$field]);
        }

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return 'Usuário(a) atualizado com sucesso!';
        } else {
            throw new \Exception("Falha ao atualizar usuário(a)!");
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

        $sql = 'DELETE FROM ' . self::$table . ' WHERE id = :id';
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
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
}
?>
>>>>>>> e0011e9971c696fac3bdaa00eb3248b24ec8db18
