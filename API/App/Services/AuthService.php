<?php
namespace App\Services;

use App\Models\User;
use Firebase\JWT\JWT;

class AuthService
{ 

    public function logout()
    {
        // Inicia a sessão se não estiver iniciada
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        // Destroi a sessão
        session_destroy();
    
        // Redireciona para a página de login
        header("Location: http://localhost/GR-09-2023-2-BG-PATRICK-OLIVEIRA/login");
        exit;
    }

    public function verificarUsuario($currentPage)
    {
        // Verifica se a sessão está definida
        if (!isset($_SESSION)) {
            session_start();
        }
        
        if (!isset($_SESSION['user_id'])) {
            http_response_code(401);
            error_log('Usuário não autenticado');
            // Retorna um indicador de erro
            return ['status' => 'error', 'message' => 'Ocorreu um erro ao mostrar a página.'];
        }

        $perfilAdminPermitido = 'admin'; // Ajuste conforme necessário

        // Se a página requer permissão de administrador
        if ($this->paginaRequerPermissaoAdmin($currentPage) && $_SESSION['tipo_user'] !== $perfilAdminPermitido) {
            http_response_code(403);
            error_log('Usuário não possui permissão para acessar esta página');
            // Retorna um indicador de erro
            return ['status' => 'error', 'message' => 'Usuário não possui permissão para acessar esta página'];
        }

        // Verificar se a sessão expirou
        if (time() > $_SESSION['exp']) {
            http_response_code(401);
            error_log('Sessão expirada');
            // Retorna um indicador de erro
            return ['status' => 'error', 'message' => 'Sessão expirada'];
        }

        // Se chegou até aqui, tudo está correto
        error_log('Usuário autenticado e possui acesso à página');
        // Retorna um indicador de sucesso
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