<?php
namespace App\Services;

use App\Models\User;

class UserService
{   
    public function processRequest($url, $queryParams) 
    {
        $endpoint = array_shift($url);
    
        switch ($endpoint) {
            case 'getUser':
                return $this->getUser($queryParams);
            case 'registerNewUser':
                return $this->registerNewUser();
            case 'updateUserById':
                return $this->updateUserById($queryParams);
            case 'deleteUserById':
                return $this->deleteUserById($queryParams);
            case 'userLogin':
                return $this->userLogin();
            default:
                throw new \Exception("Endpoint não encontrado!");
        }
    }
    
    /**
     * Obtém um usuário pelo ID ou todos os usuários.
     * @param int|null $id O ID do usuário a ser obtido (opcional).
     * @return array Os dados do usuário ou um array de usuários.
    */
    public function getUser($queryParams = array()) 
    {
        // Verifique se o ID está presente nos query parameters
        if (isset($queryParams['id'])) {
            $id = $queryParams['id'];
            return User::selectUser($id);
        } else {
            return User::selectAllUser();
        }
    }

    /**
     * Registra um novo usuário.
     * @return string Uma mensagem de sucesso.
    */
    public function registerNewUser() 
    {
        $data = $_POST;
        return User::registerNewUser($data);
    }

    /**
     * Atualiza um usuário pelo ID.     
     * @param int $id O ID do usuário a ser atualizado.
     * @return string Uma mensagem de sucesso.
    */
    public function updateUserById($id) 
    {
        $data = $_POST;
        return User::updateUserById($id, $data);
    }

    /**
     * Exclui um usuário pelo ID.
     * @param int $id O ID do usuário a ser excluído.
     * @return string Uma mensagem de sucesso.
    */

    public function deleteUserById($id) 
    {
        return User::deleteUserById($id);
    }

    /**
     * Faz login de um usuário.
     * @return string 'Sucesso' se o login for bem-sucedido, 'Erro' se o login falhar.
    */
    public function userLogin() 
    {
        $data = $_POST;        
        return User::userLogin($data['login'], $data['senha']);
    }
}
?>
