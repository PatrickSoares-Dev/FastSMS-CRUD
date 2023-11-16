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

        // Construa a consulta SQL para atualizar todos os campos
        $fields = '';
        foreach ($data as $key => $value) {
            $fields .= "$key = :$key, ";
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
            return 'Usuário atualizado com sucesso!';
        } else {
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

