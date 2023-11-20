<?php
namespace App\Services;

use App\Models\User;
use Firebase\JWT\JWT;

class AuthService

{ 

    public function logout()
    {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $userId = $_SESSION['user_id'] ?? null;
        $userName = $_SESSION['user_name'] ?? null;

        $logDataLogout = [
            'email_usuario' => $userId, 
            'tipo_acao' => 'UserLogout',
            'descricao_log' => "O usuário $userName fez logout do sistema.",
            'data_log' => date('Y-m-d H:i:s'),
        ];

        User::insertLog($logDataLogout);
    

        session_destroy();
    

        header("Location: http://localhost/GR-06-2023-2-BG-PATRICK-OLIVEIRA/login");
        exit;
    }

    public function verificarUsuario($currentPage)
    {

        if (!isset($_SESSION)) {
            session_start();
        }
        

        $userId = $_SESSION['user_id'] ?? null;
        $userName = $_SESSION['user_name'] ?? null;
        $userType = $_SESSION['tipo_user'] ?? null;

        if (!isset($_SESSION['user_id'])) {
            http_response_code(401);
            error_log('Usuário não autenticado');

            return ['status' => 'error', 'message' => 'Ocorreu um erro ao mostrar a página.'];
        }

        $perfilAdminPermitido = 'Admin'; 

        if ($this->paginaRequerPermissaoAdmin($currentPage) && $_SESSION['tipo_user'] !== $perfilAdminPermitido) {
            http_response_code(403);
            error_log('Usuário não possui permissão para acessar esta página');
            $logDataNoPermission = [
                'email_usuario' => $userId, 
                'tipo_acao' => 'AccessAttempt',
                'descricao_log' => "O usuário $userName tentou acessar a página $currentPage sem permissão.",
                'data_log' => date('Y-m-d H:i:s'),
            ];

            User::insertLog($logDataNoPermission);
            return ['status' => 'error', 'message' => 'Usuário não possui permissão para acessar esta página'];
        }


        if (time() > $_SESSION['exp']) {
            http_response_code(401);
            error_log('Sessão expirada');

            // $logDataSessionExpired = [
            //     'email_usuario' => $userId, 
            //     'tipo_acao' => 'SessionExpired',
            //     'descricao_log' => "A sessão do usuário $userName expirou.",
            //     'data_log' => date('Y-m-d H:i:s'),
            // ];
            
            // User::insertLog($logDataSessionExpired);

            return ['status' => 'error', 'message' => 'Sessão expirada'];
        }

        error_log('Usuário autenticado e possui acesso à página');

        return ['status' => 'success'];
    }

    
    private function paginaRequerPermissaoAdmin($currentPage)
    {
        // Lista de páginas que requerem permissão de administrador
        $paginasQueRequeremAdmin = ['users', 'logs', 'bd'];

        return in_array($currentPage, $paginasQueRequeremAdmin);
    }
        
}
?>