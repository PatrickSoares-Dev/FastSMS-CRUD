<?php

namespace App\Models;

class User
{
    private static $table = 'usuarios'; // Nome da nova tabela

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

    public static function registerNewUser($data)
    {
        try {
            $connPdo = new \PDO(DBDRIVE . ':host=' . DBHOST . ';dbname=' . DBNAME, DBUSER, DBPASS);

            // Verifica se já existe um usuário com o mesmo login ou email
            $checkUserQuery = 'SELECT * FROM ' . self::$table . ' WHERE login = :login OR email = :email';
            $stmtCheckUser = $connPdo->prepare($checkUserQuery);
            $stmtCheckUser->bindValue(':login', $data['login']);
            $stmtCheckUser->bindValue(':email', $data['email']);
            $stmtCheckUser->execute();

            if ($stmtCheckUser->rowCount() > 0) {
                // Retorna uma resposta de erro informando que já existe um usuário com os mesmos dados
                http_response_code(409);
                return [
                    'status' => 'error',
                    'message' => 'Já existe um usuário com o mesmo login ou email.'
                ];
            } else {
                // Se não houver duplicatas, prossiga com a inserção do usuário
                $insertUserQuery = 'INSERT INTO ' . self::$table . ' (nome, dataNascimento, sexo, mae, cpf, celular, tel, cep, endereco, numeroEndereco, complemento, cidade, estado, login, senha, tipo_user, email) VALUES (:nome, :dataNascimento, :sexo, :mae, :cpf, :celular, :tel, :cep, :endereco, :numeroEndereco, :complemento, :cidade, :estado, :login, :senha, :tipo_user, :email)';
                $stmtInsertUser = $connPdo->prepare($insertUserQuery);
                // Atribua os valores usando bindValue
                $stmtInsertUser->bindValue(':nome', $data['nome']);
                $stmtInsertUser->bindValue(':dataNascimento', $data['dataNascimento']);
                $stmtInsertUser->bindValue(':sexo', $data['sexo']);
                $stmtInsertUser->bindValue(':mae', $data['mae']);
                $stmtInsertUser->bindValue(':cpf', $data['cpf']);
                $stmtInsertUser->bindValue(':celular', $data['celular']);
                $stmtInsertUser->bindValue(':tel', $data['tel']);
                $stmtInsertUser->bindValue(':cep', $data['cep']);
                $stmtInsertUser->bindValue(':numeroEndereco', $data['numeroEndereco']);
                $stmtInsertUser->bindValue(':endereco', $data['endereco']);
                $stmtInsertUser->bindValue(':complemento', $data['complemento']);        
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
        } catch (\Exception $e) {
            // Retorna uma resposta de erro caso ocorra uma exceção
            http_response_code(500);
            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
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
        $validFields = ['nome', 'dataNascimento', 'sexo', 'mae', 'cpf', 'celular', 'tel', 'cep', 'endereco', 'cidade', 'estado', 'login', 'senha', 'tipo_user'];

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
