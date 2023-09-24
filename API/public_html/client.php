<<<<<<< HEAD
<?php

    $url = 'http://localhost/FastSMS/API/public_html/api';

    $class = '/user'; // Use "/user" para acessar o UserService
    $param = '';

    $response = file_get_contents($url . $class . $param);


    //echo $response;

    //
    //$response = json_decode($response, 1);
=======
<?php

    $url = 'http://localhost/FastSMS/API/public_html/api';

    $class = '/user'; // Use "/user" para acessar o UserService
    $param = '';

    $response = file_get_contents($url . $class . $param);


    //echo $response;

    //
    //$response = json_decode($response, 1);
>>>>>>> e0011e9971c696fac3bdaa00eb3248b24ec8db18
    //var_dump($response['data'][1]['email']);