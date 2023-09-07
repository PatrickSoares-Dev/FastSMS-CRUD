<?php

class UsersModel
{
    public static function GetAllUsers()
    {
        $Connection = Connection::getConnection();

        $sql = "SELECT * FROM usuarios ORDER BY id DESC";
        $sql = $Connection -> prepare($sql);
        $sql->execute();

        $resultado = array();

        while ($row = $sql->fetchObject('UsersModel'))
        {
            $resultado[] = $row;
        }

        if(!$resultado){
            throw new Exception ("Não foi encontrado nenhum usuário no banco de dados");
        }

        return $resultado;

    }
}

?>