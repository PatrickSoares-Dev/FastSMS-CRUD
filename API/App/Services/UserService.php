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
            case 'checkEmailExists':
                    return $this->checkEmailExists($queryParams);
            case 'updateUserById':
                    return $this->updateUserById($queryParams);
            case 'registerUser':
                return $this->registerUser($_POST);
            case 'deleteUserById':
                return $this->deleteUserById($queryParams);
            case 'userLogin': 
                    return $this->userLogin();              
            case 'twofa': 
                return $this->twofaAuth($_POST); 
            case 'getAllLogs':
                return $this->getAllLogs();
            case 'deleteLog':
                    return $this->deleteLog($queryParams);
            case 'forgotUser':
                return $this->forgotUser($queryParams);
            case 'updateForgotUser':
                return $this->updateForgotUser($_POST); // Se os dados estiverem no corpo da solicitação POST
                
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

    public function checkEmailExists($queryParams)
    {
        try {
            if (isset($queryParams['email'])) {
                $email = $queryParams['email'];
                $user = User::selectUserByField('email', $email);
                
                if ($user) {
                    return ['status' => 'success', 'message' => 'Email encontrado no banco de dados.'];
                } else {
                    return ['status' => 'success', 'message' => 'Email não encontrado no banco de dados.'];
                }
            } else {
                throw new \Exception("O parâmetro 'email' não foi fornecido na solicitação.", 400);
            }
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    public function registerUser($requestData)
    {
        try {
            // Verifique se os campos obrigatórios estão presentes nos dados da solicitação
            $requiredFields = [
                'nome', 'mae', 'cpf', 'dataNascimento', 'tel', 'sexo',
                'cep', 'estado', 'cidade', 'numeroEndereco', 'endereco',
                'complemento', 'email', 'celular', 'senha', 'login'
            ];
            
            // Adicione 'tipo_user' com o valor padrão 'User' aos dados
            $requestData['tipo_user'] = 'User';

            foreach ($requiredFields as $field) {
                if (!isset($requestData[$field])) {
                    throw new \Exception("O campo '$field' é obrigatório.");
                }
            }

            // Verifique duplicatas nos campos CPF, TEL, EMAIL, CELULAR e LOGIN
            $duplicateFields = [];
            $existingUser = User::selectUserByField('cpf', $requestData['cpf']);
            if ($existingUser) {
                $duplicateFields[] = 'CPF';
            }
            $existingUser = User::selectUserByField('tel', $requestData['tel']);
            if ($existingUser) {
                $duplicateFields[] = 'TEL';
            }
            $existingUser = User::selectUserByField('email', $requestData['email']);
            if ($existingUser) {
                $duplicateFields[] = 'EMAIL';
            }
            $existingUser = User::selectUserByField('celular', $requestData['celular']);
            if ($existingUser) {
                $duplicateFields[] = 'CELULAR';
            }
            $existingUser = User::selectUserByField('login', $requestData['login']);
            if ($existingUser) {
                $duplicateFields[] = 'LOGIN';
            }

            if (!empty($duplicateFields)) {
                throw new \Exception("Campos duplicados: " . implode(', ', $duplicateFields));
            }

            // Se não houver duplicatas, insira o novo usuário no banco de dados
            $message = User::insertUser($requestData);

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
            if (isset($requestData['id'])) {
                $id = $requestData['id'];
                $user = User::selectUser($id);
    
                if (!$user) {
                    throw new \Exception("Usuário com ID $id não encontrado.", 404);
                }
    
                // Atualize o usuário com base nos dados fornecidos
                $user = array_merge($user, $requestData);
    
                // Remove o campo "url" para evitar problemas
                if (isset($user['url'])) {
                    unset($user['url']);
                }
    
                // Atualize o usuário no banco de dados
                $message = User::updateUser($id, $user);
    
                return ['status' => 'success', 'message' => $message];
            } else {
                throw new \Exception("ID do usuário não fornecido na solicitação.", 400);
            }
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
    public function userLogin()
    {
        try {
            if (isset($_POST['login']) && isset($_POST['senha'])) {
                $loginOrEmail = $_POST['login'];
                $senha = $_POST['senha'];

                // Verifica se o loginOrEmail parece ser um email
                $field = filter_var($loginOrEmail, FILTER_VALIDATE_EMAIL) ? 'email' : 'login';

                $userStatus = User::userLogin($loginOrEmail, $senha);

                if ($userStatus === 'Sucesso') {
                    // Consulta o banco de dados para obter os detalhes do usuário
                    $authenticatedUser = User::selectUserByField($field, $loginOrEmail);

                    if ($authenticatedUser) {
                        http_response_code(200);
                        
                        if ($authenticatedUser['tipo_user'] === 'Admin') {
                            // Crie a sessão para administrador
                            $this->createAdminSession($authenticatedUser);
                            // Resposta para admin
                            return [
                                'status' => 'success',
                                'message' => 'Login de administrador bem-sucedido.',
                                'user_id' => $authenticatedUser['id']
                            ];
                        } else {
                            $logDataSuccess = [
                                'email_usuario' => $authenticatedUser['email'],
                                'tipo_acao' => 'UserLoginSuccess',
                                'descricao_log' => 'Autenticação bem-sucedida. Necessário segundo fator de autenticação.',
                                'data_log' => date('Y-m-d H:i:s'),
                            ];
        
                            User::insertLog($logDataSuccess);

                            return [
                                'status' => 'success',
                                'message' => 'Autenticação bem sucedida. Necessário segundo fator de autenticação.',
                                'user_id' => $authenticatedUser['id'] // ID do usuário autenticado
                            ];
    
                        }
                                            
                    } else {
                        http_response_code(401);
                        return [
                            'status' => 'error',
                            'message' => 'Usuário não encontrado'
                        ];
                    }
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
    
    private function createAdminSession($authenticatedUser)
    {
        // Defina as informações necessárias para a sessão do administrador
        $id_user = $authenticatedUser['id'];
        $userDetails = $authenticatedUser;

        $tokenPayload = [
            'user_id' => $id_user,
            'exp' => time() + 3600 // Define o tempo de expiração do token (1 hora)
        ];
        $secretKey = 'seu_segredo_secreto'; // Substitua pelo seu segredo secreto

        $token = JWT::encode($tokenPayload, $secretKey, 'HS256');

        // Inicie a sessão
        session_start();

        // Armazene informações do usuário na sessão
        $_SESSION['user_id'] = $id_user;
        $_SESSION['tipo_user'] = $userDetails['tipo_user'];
        $_SESSION['user_name'] = $userDetails['login'];
        $_SESSION['token'] = $token;
        $_SESSION['exp'] = $tokenPayload['exp'];

        $expiration = date('Y-m-d H:i:s', $tokenPayload['exp']);

        // Construa a resposta com o token JWT e informações do usuário
        $response = [
            'status' => 'success',
            'message' => 'Autenticação bem-sucedida',
            'data' => [
                'access_token' => $token,
                'token_type' => 'Bearer',
                'expires_in' => 3600,
                'user_id' => $id_user,
                'tipo_user' => $userDetails['tipo_user']
            ]
        ];

        $logDataSuccess = [
            'email_usuario' => $userDetails['email'],
            'tipo_acao' => 'AdminLogin',
            'descricao_log' => "O administrador se autenticou no sistema - Data de expiração do token: $expiration",
            'data_log' => date('Y-m-d H:i:s'),
        ];

        User::insertLog($logDataSuccess);

        http_response_code(200);

        return $response;
    }

    public function twofaAuth($requestData)
    {
        try {
            error_log("Início da autenticação de dois fatores"); // Mensagem de log

            $id_user = $requestData['id'];
            $currentQuestion = $requestData['question'];
            $answer = $requestData['answer'];

            // Recupere o usuário pelo ID
            $user = $this->getUser(['id' => $id_user]);

            if ($user['status'] === 'error') {
                error_log("Usuário nao encontrado!"); // Mensagem de log
                throw new \Exception("Usuario nao encontrado!");
            }

            $userDetails = $user['data'];
            $correctAnswers = 0;

            // Antes da verificação das respostas
            error_log("currentQuestion: $currentQuestion");
            error_log("answer: $answer");
            error_log("userDetails['mae']: " . $userDetails['mae']);
            error_log("userDetails['dataNascimento']: " . $userDetails['dataNascimento']);
            error_log("userDetails['cep']: " . $userDetails['cep']);

            // Verifique a pergunta atual
            if ($currentQuestion === 'twofa_mae' && $userDetails['mae'] === $answer) {
                error_log($answer . $userDetails['mae']);

                $logDataSuccess = [
                    'email_usuario' => $userDetails['email'],
                    'tipo_acao' => 'TwofaSuccess',
                    'descricao_log' => "Confirmou segundo fator de autenticação: pergunta escolhida. - ($currentQuestion)",
                    'data_log' => date('Y-m-d H:i:s'),
                ];
                User::insertLog($logDataSuccess);

                $correctAnswers++;

            } elseif ($currentQuestion === 'twofa_data' && $userDetails['dataNascimento'] === $answer) {
                $logDataSuccess = [
                    'email_usuario' => $userDetails['email'],
                    'tipo_acao' => 'TwofaSuccess',
                    'descricao_log' => "Confirmou segundo fator de autenticação: pergunta escolhida. - ($currentQuestion)",
                    'data_log' => date('Y-m-d H:i:s'),
                ];
                User::insertLog($logDataSuccess);

                $correctAnswers++;

            } elseif ($currentQuestion === 'twofa_cep' && $userDetails['cep'] === $answer) {
                $logDataSuccess = [
                    'email_usuario' => $userDetails['email'],
                    'tipo_acao' => 'TwofaSuccess',
                    'descricao_log' => "Confirmou segundo fator de autenticação: pergunta escolhida. - ($currentQuestion)",
                    'data_log' => date('Y-m-d H:i:s'),
                ];

                User::insertLog($logDataSuccess);
                $correctAnswers++;
            }

            if ($correctAnswers === 1) {
                

                // Crie a sessão e um token de acesso
                $tokenPayload = [
                    'user_id' => $id_user,
                    'exp' => time() + 3600 // Define o tempo de expiração do token (1 hora)
                ];
                $secretKey = 'seu_segredo_secreto'; // Substitua pelo seu segredo secreto

                $token = JWT::encode($tokenPayload, $secretKey, 'HS256');

                // Inicie a sessão
                session_start();

                // Armazene informações do usuário na sessão
                $_SESSION['user_id'] = $id_user;
                $_SESSION['tipo_user'] = $userDetails['tipo_user'];
                $_SESSION['user_name'] = $userDetails['login'];
                $_SESSION['token'] = $token;
                $_SESSION['exp'] = $tokenPayload['exp'];

                $expiration = date('Y-m-d H:i:s', $tokenPayload['exp']);                

                // Construa a resposta com o token JWT e informações do usuário
                $response = [
                    'status' => 'success',
                    'message' => 'Autenticação bem-sucedida',
                    'data' => [
                        'access_token' => $token,
                        'token_type' => 'Bearer',
                        'expires_in' => 3600,
                        'user_id' => $id_user,
                        'tipo_user' => $userDetails['tipo_user']
                    ]
                ];

                $logDataSuccess = [
                    'email_usuario' => $userDetails['email'],
                    'tipo_acao' => 'UserLogin',
                    'descricao_log' => "O usuário se autenticou no sistema FastSMS - Data de expiração do token: $expiration",
                    'data_log' => date('Y-m-d H:i:s'),
                ];
                
                User::insertLog($logDataSuccess);

                http_response_code(200);
               

                return $response;
            } else {
                // Perguntas de autenticação incorretas
                error_log("Respostas incorretas nas perguntas de autenticação"); // Mensagem de log

                $logDataFailed = [
                    'email_usuario' => $userDetails['email'], // Preencher com o email, se disponível
                    'tipo_acao' => 'TwofaFailed',
                    'descricao_log' => "Respostas incorretas nas perguntas de autenticação. - ($currentQuestion)",
                    'data_log' => date('Y-m-d H:i:s'),
                ];
    
                User::insertLog($logDataFailed);

                http_response_code(401);
                return [
                    'status' => 'error',
                    'message' => 'Respostas incorretas nas perguntas de autenticação.'
                ];
            }
        } catch (\Exception $e) {
            error_log("Erro: " . $e->getMessage()); // Mensagem de log
            $statusCode = $e->getCode() ?: 400;
            http_response_code($statusCode);
            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
    }  

    public function forgotUser($queryParams)
    {
        try {
            if (isset($queryParams['email']) && isset($queryParams['question']) && isset($queryParams['answer'])) {
                // Buscar o usuário pelo email no banco de dados
                $user = User::selectUserByField('email', $queryParams['email']);

                if (!$user) {
                    throw new \Exception("Usuário não encontrado para o email fornecido.");
                }

                // Obter a pergunta e a resposta fornecidas
                $question = $queryParams['question'];
                $providedAnswer = $queryParams['answer'];

                $UserEmail = $user['email'];

                // Verificar se a pergunta está entre as perguntas de segurança permitidas
                if ($question !== 'mae' && $question !== 'dataNascimento' && $question !== 'cep') {

                    $logDataError = [
                        'email_usuario' => $UserEmail ,
                        'tipo_acao' => 'ForgotPasswordError',
                        'descricao_log' => "O usuário $UserEmail solicitou a alteração de senha e errou a pergunta de segurança.",
                        'data_log' => date('Y-m-d H:i:s'),
                    ];
                    
                    User::insertLog($logDataError);

                    throw new \Exception("Pergunta de segurança inválida.");
                }

                // Verificar se a resposta fornecida corresponde à resposta no banco de dados
                if ($user[$question] === $providedAnswer) {
                    
                    $logDataSuccess = [
                        'email_usuario' => $UserEmail ,
                        'tipo_acao' => 'ForgotPasswordSucess',
                        'descricao_log' => "O usuário $UserEmail solicitou a alteração de senha e acertou a pergunta de segurança.",
                        'data_log' => date('Y-m-d H:i:s'),
                    ];
                    
                    User::insertLog($logDataSuccess);

                    return ['status' => 'success', 'message' => 'Resposta de segurança correta.'];
                } else {
                    // Resposta incorreta
                    throw new \Exception("Resposta de segurança incorreta.");
                }
            } else {
                throw new \Exception("Dados incompletos na solicitação.");
            }
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
}

    public function updateForgotUser($requestData)
    {
        try {
            if (isset($requestData['email']) && isset($requestData['novaSenha'])) {
                // Buscar o usuário pelo email no banco de dados
                $user = User::selectUserByField('email', $requestData['email']);

                if (!$user) {
                    throw new \Exception("Usuário não encontrado para o email fornecido.");
                }

                // Atualizar a senha do usuário
                $user['senha'] = $requestData['novaSenha'];
                $message = User::updateUser($user['id'], $user);
                
                $UserEmail  = $user['email'];

                $logDataSuccess = [
                    'email_usuario' => $UserEmail ,
                    'tipo_acao' => 'ForgotPasswordSucess',
                    'descricao_log' => "O usuário $UserEmail alterou a senha.",
                    'data_log' => date('Y-m-d H:i:s'),
                ];

                User::insertLog($logDataSuccess);

                return ['status' => 'success', 'message' => $message];
            } else {
                throw new \Exception("Email do usuário ou nova senha não fornecidos na solicitação.");
            }
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }


    public function getAllLogs()
    {
        try {
            $logs = User::selectAllLogs();
            return ['status' => 'success', 'data' => $logs];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    public function deleteLog($queryParams)
    {
        try {
            if (isset($queryParams['id'])) {
                $logId = $queryParams['id'];
                $message = User::deleteLogById($logId);
                return ['status' => 'success', 'message' => $message];
            } else {
                throw new \Exception("ID do log não fornecido na solicitação.", 400);
            }
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

}
?>