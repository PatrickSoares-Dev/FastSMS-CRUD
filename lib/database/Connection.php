<?php

class Connection {
    private static $connection;

    private function __construct() {
        // Impede a criação de instâncias desta classe
    }

    public static function getConnection() {
        if (self::$connection === null) {
            try {
                self::$connection = new PDO('mysql:host=localhost;dbname=fastsms', 'root', '');
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die('Erro na conexão com o banco de dados: ' . $e->getMessage());
            }
        }
        return self::$connection;
    }
}
