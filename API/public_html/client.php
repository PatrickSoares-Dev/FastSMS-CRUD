<?php

    $url = 'http://localhost/GR-09-2023-2-BG-PATRICK-OLIVEIRA/API/public_html/api';

    $class = '/user'; // Use "/user" para acessar o UserService
    $param = '';

    $response = file_get_contents($url . $class . $param);


    //echo $response;

    //
    //$response = json_decode($response, 1);
    //var_dump($response['data'][1]['email']);