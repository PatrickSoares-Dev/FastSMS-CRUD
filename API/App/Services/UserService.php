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
            case 'deleteUserById':
                return $this->deleteUserById($queryParams);
            case 'userLogin':
                return $this->userLogin();
            case 'registerUser':
                return $this->registerUser();
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

    public function registerUser()
    {
        try {
            // Lê o JSON enviado
            $json = file_get_contents('php://input');

            // Converte o JSON em um array associativo
            $queryParams = json_decode($json, true);

            if ($queryParams === null) {
                throw new \Exception("Erro ao decodificar os dados JSON.");
            }

            // Agora você pode acessar os campos como $queryParams['nome'], $queryParams['mae'], etc.

            // Extrai os dados necessários dos $queryParams
            $userData = [
                'nome' => $queryParams['nome'],
                'mae' => $queryParams['mae'],
                'cpf' => $queryParams['cpf'],
                'dataNascimento' => $queryParams['dataNascimento'],
                'tel' => $queryParams['tel'],
                'sexo' => $queryParams['sexo'],
                'cep' => $queryParams['cep'],
                'estado' => $queryParams['estado'],
                'cidade' => $queryParams['cidade'],
                'numeroEndereco' => $queryParams['numeroEndereco'],
                'endereco' => $queryParams['endereco'],
                'email' => $queryParams['email'],
                'login' => $queryParams['login'],
                'celular' => $queryParams['celular'],
                'senha' => $queryParams['senha'],
                'tipo_user' => $queryParams['tipo_user'],
                // Adicione quaisquer outros campos necessários aqui
            ];

            // Adicione instruções de depuração para verificar os dados recebidos
            error_log('Dados recebidos para registro de usuário:');
            error_log(print_r($userData, true));

            // Chama o método no modelo User.php para inserir o novo usuário no banco de dados
            $message = User::insertUser($userData);

            // Adicione instruções de depuração para verificar a mensagem de retorno
            error_log('Mensagem de retorno do registro de usuário:');
            error_log(print_r($message, true));

            // Retorna a resposta em formato JSON
            return json_encode(['status' => 'success', 'message' => $message]);
        } catch (\Exception $e) {
            // Em caso de exceção, também retorne a resposta em formato JSON
            return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
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
                if (User::userAuthentication($data['login'], $data['senha'])) {
                    // Gera um token JWT
                    $tokenPayload = [
                        'user_id' => 123, 
                        'exp' => time() + 10800 
                    ];
                    $secretKey = 'no_sigilo'; 
    
                    $token = JWT::encode($tokenPayload, $secretKey, 'HS256');
    
                    // Construa a resposta com o token JWT
                    $response = [
                        'status' => 'success',
                        'message' => 'Autenticação bem-sucedida',
                        'data' => [
                            'access_token' => $token,
                            'token_type' => 'Bearer',
                            'expires_in' => 10800,
                        ]
                    ];
    
                    http_response_code(200);
                    return json_encode($response); // Retorna a resposta como JSON
                } else {
                    http_response_code(401);
                    return json_encode([
                        'status' => 'error',
                        'message' => 'Usuário ou senha incorretos'
                    ]);
                }
            } else {
                http_response_code(400);
                throw new \Exception("Login e senha não fornecidos.", 400);
            }
        } catch (\Exception $e) {
            $statusCode = $e->getCode() ?: 400;
            http_response_code($statusCode);
            return json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
}
?>
