<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once 'API/App/Services/AuthService.php';

$authService = new \App\Services\AuthService();

// Verifica se a página requer autenticação
$authenticationRequired = true;

// Lista de páginas que não requerem autenticação
$nonAuthenticatedPages = ['login', 'register', 'forgot'];

// Obtém a URL completa
$currentURL = $_SERVER['REQUEST_URI'];

// Remove a parte do domínio
$baseFolder = basename(dirname($_SERVER['SCRIPT_NAME']));

// Remove o nome da pasta da URL
$rota = ltrim(str_replace("/$baseFolder", '', $currentURL), '/');

// Remove a barra inicial, se presente
$rota = ltrim($rota, '/');

// Separe as partes da URL
$parts = explode("/", $rota);

// Se a URL for vazia, defina $currentPage como 'login'
if (empty($parts) || empty($parts[0])) {
    $currentPage = 'login';
} else {
    $currentPage = $parts[0];
    
    // Verifica se a página não requer autenticação
    if (in_array($currentPage, $nonAuthenticatedPages)) {
        $authenticationRequired = false;
    }
}

if ($authenticationRequired) {
    $resultadoVerificacaoUsuario = $authService->verificarUsuario($currentPage);

    if ($resultadoVerificacaoUsuario['status'] === 'error') {
        // Inclua a página de erro diretamente
        include "app/Views/Shared/Error.php";
        include "app/Layout/Layout.php";
        exit(); 
    }
    
}

// Restante do seu código

// Se houver algo na URL que não seja 'login', 'register' ou 'forgot', use o DashboardLayout.php
if ($currentPage !== 'login' && $currentPage !== 'register' && $currentPage !== 'forgot') {
    include "app/Layout/DashboardLayout.php";
} else {
    include "app/Views/{$currentPage}/{$currentPage}.php";
    include "app/Layout/Layout.php"; // Renderize o Layout.php para login, register ou forgot
}
?>
