<?php

class HomeController
{
    public function index()
    {

        try{
            
            $loader = new \Twig\Loader\FilesystemLoader('app/Views/Authentication/');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('register.php');

            $parametros = array();


            $conteudo = $template-> render ($parametros);
            echo($conteudo); 

        }catch (Exception $e){
            echo $e->getMessage();
        }
    }
    public function login()
    {

        ///render
      
    }

    public function registro()
    {

        ///render
      
    }

    public function dashboard()
    {

        ///render
      
    }
}