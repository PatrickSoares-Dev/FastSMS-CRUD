<?php

    $url = 'http://localhost/FastSMS/API/public_html/api';

    $class = '/user'; // Use "/user" para acessar o UserService
    $param = '';

    $jsonInput = file_get_contents('php://input');
    $data = json_decode($jsonInput, true);



    //echo $response;

    //
    //$response = json_decode($response, 1);
    //var_dump($response['data'][1]['email']);