<?php

class HomeController
{
    public function index()
    {
        try{
            $loader = new \Twig\Loader\FilesystemLoader('app/Views/Registration');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('register.php');

            $parametros = array();
            $parametros['nome'] = 'Patrick';

            $conteudo = $template->render($parametros);
            echo $conteudo;


        }catch (Exception $e){
            echo $e->getMessage();
        }
    }

    public function GetAllUsers()
    {
        $allUsers = UsersModel::GetAllUsers();

        header('Content-Type: application/json');
        echo json_encode($allUsers);
    }

}