<?php
    header('Content-Type: application/json');

    require_once '../vendor/autoload.php';

    if ($_GET['url']) {
        $url = explode('/', $_GET['url']);

        if ($url[0] === 'api') {
            array_shift($url);

            $service = 'App\Services\\' . ucfirst($url[0]) . 'Service';
            array_shift($url);

            // Use o método HTTP correto (GET) para acessar a rota processRequest
            $method = 'processRequest';

            // Obtenha os parâmetros de consulta da URL
            $queryParams = $_GET;

            try {
                // Adicione os parâmetros de consulta como um terceiro argumento
                $response = call_user_func_array(array(new $service, $method), array($url, $queryParams));

                http_response_code(200);
                echo json_encode(array('status' => 'success', 'data' => $response));
                exit;
            } catch (\Exception $e) {
                http_response_code(404);
                echo json_encode(array('status' => 'error', 'data' => $e->getMessage()), JSON_UNESCAPED_UNICODE);
                exit;
            }
        }
    }
?>