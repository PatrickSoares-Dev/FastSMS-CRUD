<?php

namespace App\Services;

use Firebase\JWT\JWT;

class AuthService
{
    public function authenticateUser($userDetails)
    {
        $id_user = $userDetails['id'];

        // Crie a sessão e um token de acesso
        $tokenPayload = [
            'user_id' => $id_user,
            'exp' => time() + 3600 // Define o tempo de expiração do token (1 hora)
        ];

        $secretKey = 'no_sigilo'; // Substitua pelo seu segredo secreto

        $token = JWT::encode($tokenPayload, $secretKey, 'HS256');

        // Construa a resposta com o token JWT e informações do usuário
        return [
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
    }
}