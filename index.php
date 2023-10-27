<?php
    // Obtém a URL completa
    $currentURL = $_SERVER['REQUEST_URI'];

    
    // Remove a parte do domínio e o "fastSMS/"
    $rota = str_replace('/FastSMS/', '', $currentURL);

    
    // Verifique se a chave 'url' está definida em $_GET
    if (isset($rota)) {
        // Separe as partes da URL
        $parts = explode("/", $rota);
  
        // Se a URL for vazia, defina $currentPage como 'login'
        if ($parts[0] == '') {
            $currentPage = 'login';    
            include "app/Views/{$currentPage}/{$currentPage}.php";
            include "app/Layout/Layout.php";
        } elseif (count($parts) > 0) {            
            // Se houver algo na URL que não seja 'login', 'register' ou 'forgot', use o DashboardLayout.php
            $currentPage = $parts[0];

            if ($currentPage !== 'login' && $currentPage !== 'register' && $currentPage !== 'forgot') {
                include "app/Layout/DashboardLayout.php";                
            } else {
                include "app/Views/{$currentPage}/{$currentPage}.php";
                include "app/Layout/Layout.php"; // Renderize o Layout.php para login, register ou forgot
            }
        }
    }
?>


