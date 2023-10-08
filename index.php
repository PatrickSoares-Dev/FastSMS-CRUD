<?php
    // Obtém a URL completa
    $currentURL = $_SERVER['REQUEST_URI'];

    // Remove a parte do domínio e o "fastSMS/"
    $rota = str_replace('/fastSMS/', '', $currentURL);

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

    // // Obtém a URL completa
    // $currentURL = $_SERVER['REQUEST_URI'];

    // // Remove a parte do domínio e o "fastSMS/"
    // $rota = str_replace('/fastSMS/', '', $currentURL);

    // // Verifique se a chave 'url' está definida em $_GET
    // if (isset($rota)) {
    //     // Verifique se a URL começa com "dashboard/"
        
    //     if (strpos($rota, 'dashboard') === 0) {
    
    //         // Separe as partes da URL
    //         $parts = explode("/", $rota);
    //         // Se a URL for "/dashboard" ou "/dashboard/", defina $currentPage como 'Home'
    //         if (count($parts) == 1) {        
    //             $currentPage = 'dashboard';
    //         } else if(count($parts) > 1){
    //             $currentPage = ($parts[0].'/'.$parts[1]);                
    //         }
    //         include "app/Layout/DashboardLayout.php";
    //     } else {
            
    //         $currentPage = 'login';
    //         $currentPage = explode("/", $rota)[0];            
    //         include "app/Views/{$currentPage}/{$currentPage}.php";
    //         include "app/Layout/Layout.php";
    //     }
    
    // } 
?>


