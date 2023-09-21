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
    
        $sql = 'INSERT INTO ' . self::$table . ' (nome, data_nascimento, sexo, nome_materno, cpf, celular, telefone_fixo, cep, endereco, cidade, estado, login, senha, tipo_user) VALUES (:nome, :data_nascimento, :sexo, :nome_materno, :cpf, :celular, :telefone_fixo, :cep, :endereco, :cidade, :estado, :login, :senha, :tipo_user)';
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':nome', $data['nome']);
        $stmt->bindValue(':data_nascimento', $data['data_nascimento']);
        $stmt->bindValue(':sexo', $data['sexo']);
        $stmt->bindValue(':nome_materno', $data['nome_materno']);
        $stmt->bindValue(':cpf', $data['cpf']);
        $stmt->bindValue(':celular', $data['celular']);
        $stmt->bindValue(':telefone_fixo', $data['telefone_fixo']);
        $stmt->bindValue(':cep', $data['cep']);
        $stmt->bindValue(':endereco', $data['endereco']);
        $stmt->bindValue(':cidade', $data['cidade']);
        $stmt->bindValue(':estado', $data['estado']);
        $stmt->bindValue(':login', $data['login']);
        $stmt->bindValue(':senha', $data['senha']);
        $stmt->bindValue(':tipo_user', 'User'); // Definindo 'User' como valor padrão para tipo_user
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return 'Usuário(a) inserido com sucesso!';
        } else {
            throw new \Exception("Falha ao inserir usuário(a)!");
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
