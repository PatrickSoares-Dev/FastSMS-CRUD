<<<<<<< HEAD
<?php
namespace App\Services;

use App\Models\User;
use Firebase\JWT\JWT;

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
                throw new \Exception("Endpoint não encontrado!", 404);
        }
    }
    
    /**
     * Obtém um usuário pelo ID ou todos os usuários.
     * @param int|null $id O ID do usuário a ser obtido (opcional).
     * @return array Os dados do usuário ou um array de usuários.
    */
    public function getUser($queryParams = [])
    {
        try {
            if (isset($queryParams['id'])) {
                $id = $queryParams['id'];
                $user = User::selectUser($id);
                return ['status' => 'success', 'data' => $user];
            } else {
                $users = User::selectAllUser();
                return ['status' => 'success', 'data' => $users];
            }
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    /**
     * Registra um novo usuário.
     * @return string Uma mensagem de sucesso.
    */
    public function registerNewUser()
    {
        try {
            $data = $_POST;
            $message = User::registerNewUser($data);
            return ['status' => 'success', 'message' => $message];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    /**
     * Atualiza um usuário pelo ID.     
     * @param int $id O ID do usuário a ser atualizado.
     * @return string Uma mensagem de sucesso.
    */
    public function updateUserById($requestData)
    {
        try {
            $message = User::updateUserById($requestData);
            return ['status' => 'success', 'message' => $message];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    public function deleteUserById($queryParams)
    {
        try {
            if (isset($queryParams['id'])) {
                $id = $queryParams['id'];
                $message = User::deleteUserById($id);
                return ['status' => 'success', 'message' => $message];
            } else {
                throw new \Exception("ID do usuário não fornecido na solicitação.", 400);
            }
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    /**
     * Faz login de um usuário.
     * @return string 'Sucesso' se o login for bem-sucedido, 'Erro' se o login falhar.
    */
    public static function userLogin()
    {
        try {
            $data = $_POST;
            if (isset($data['login']) && isset($data['senha'])) {
                $message = User::userLogin($data['login'], $data['senha']);

                if ($message === 'Sucesso') {
                    // Gere um token JWT
                    $tokenPayload = [
                        'user_id' => 123, // Substitua pelo ID do usuário autenticado
                        'exp' => time() + 3600 // Define o tempo de expiração do token (1 hora)
                    ];
                    $secretKey = 'no_sigilo'; // Substitua pelo seu segredo secreto

                    $token = JWT::encode($tokenPayload, $secretKey, 'HS256');

                    // Construa a resposta com o token JWT
                    $response = [
                        'status' => 'success',
                        'message' => 'Autenticação bem-sucedida',
                        'data' => [
                            'access_token' => $token,
                            'token_type' => 'Bearer',
                            'expires_in' => 3600
                        ]
                    ];

                    http_response_code(200);
                    return $response;
                } else {
                    http_response_code(401);
                    return [
                        'status' => 'error',
                        'message' => 'Usuário ou senha incorretos'
                    ];
                }
            } else {
                http_response_code(400);
                throw new \Exception("Login e senha não fornecidos.", 400);
            }
        } catch (\Exception $e) {
            $statusCode = $e->getCode() ?: 400;
            http_response_code($statusCode);
            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
    }
}
?>
=======
<?php
namespace App\Services;

use App\Models\User;
use Firebase\JWT\JWT;

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
                throw new \Exception("Endpoint não encontrado!", 404);
        }
    }
    
    /**
     * Obtém um usuário pelo ID ou todos os usuários.
     * @param int|null $id O ID do usuário a ser obtido (opcional).
     * @return array Os dados do usuário ou um array de usuários.
    */
    public function getUser($queryParams = [])
    {
        try {
            if (isset($queryParams['id'])) {
                $id = $queryParams['id'];
                $user = User::selectUser($id);
                return ['status' => 'success', 'data' => $user];
            } else {
                $users = User::selectAllUser();
                return ['status' => 'success', 'data' => $users];
            }
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    /**
     * Registra um novo usuário.
     * @return string Uma mensagem de sucesso.
    */
    public function registerNewUser()
    {
        try {
            $data = $_POST;
            $message = User::registerNewUser($data);
            return ['status' => 'success', 'message' => $message];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    /**
     * Atualiza um usuário pelo ID.     
     * @param int $id O ID do usuário a ser atualizado.
     * @return string Uma mensagem de sucesso.
    */
    public function updateUserById($requestData)
    {
        try {
            $message = User::updateUserById($requestData);
            return ['status' => 'success', 'message' => $message];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    public function deleteUserById($queryParams)
    {
        try {
            if (isset($queryParams['id'])) {
                $id = $queryParams['id'];
                $message = User::deleteUserById($id);
                return ['status' => 'success', 'message' => $message];
            } else {
                throw new \Exception("ID do usuário não fornecido na solicitação.", 400);
            }
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    /**
     * Faz login de um usuário.
     * @return string 'Sucesso' se o login for bem-sucedido, 'Erro' se o login falhar.
    */
    public static function userLogin()
    {
        try {
            $data = $_POST;
            if (isset($data['login']) && isset($data['senha'])) {
                $message = User::userLogin($data['login'], $data['senha']);

                if ($message === 'Sucesso') {
                    // Gere um token JWT
                    $tokenPayload = [
                        'user_id' => 123, // Substitua pelo ID do usuário autenticado
                        'exp' => time() + 3600 // Define o tempo de expiração do token (1 hora)
                    ];
                    $secretKey = 'no_sigilo'; // Substitua pelo seu segredo secreto

                    $token = JWT::encode($tokenPayload, $secretKey, 'HS256');

                    // Construa a resposta com o token JWT
                    $response = [
                        'status' => 'success',
                        'message' => 'Autenticação bem-sucedida',
                        'data' => [
                            'access_token' => $token,
                            'token_type' => 'Bearer',
                            'expires_in' => 3600
                        ]
                    ];

                    http_response_code(200);
                    return $response;
                } else {
                    http_response_code(401);
                    return [
                        'status' => 'error',
                        'message' => 'Usuário ou senha incorretos'
                    ];
                }
            } else {
                http_response_code(400);
                throw new \Exception("Login e senha não fornecidos.", 400);
            }
        } catch (\Exception $e) {
            $statusCode = $e->getCode() ?: 400;
            http_response_code($statusCode);
            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
    }
}
?>
>>>>>>> e0011e9971c696fac3bdaa00eb3248b24ec8db18
