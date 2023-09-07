<?php
    // Inclua os arquivos necessários
    require_once 'app/Core/Core.php';
    require_once 'lib/database/Connection.php';
    require_once 'app/Controller/HomeController.php';
    require_once 'app/Controller/ErrorController.php';
    require_once 'app/Model/UsersModel.php';
    require_once 'vendor/autoload.php';

    $requestUri = $_SERVER['REQUEST_URI'];
    $requestUri = explode('?', $requestUri)[0]; 

    $urlParts = explode('/', trim($requestUri, '/'));

    $controllerName = 'HomeController';
    $actionName = 'index';

    if (!empty($urlParts[0])) {
        $controllerName = ucfirst($urlParts[0] . 'Controller');
        array_shift($urlParts);
    }


    if (!empty($urlParts[0])) {
        $actionName = $urlParts[0];
        array_shift($urlParts); 
    }

    ob_start();

    $core = new Core;
    $_GET['acao'] = $actionName;
    $core->start($_GET);

    $saida = ob_get_contents();

    ob_end_clean();

    $template = file_get_contents('app/Template/Layout.php');
    $tplPronto = str_replace('{{area_dinamica}}', $saida, $template);

    echo $tplPronto;
?>
