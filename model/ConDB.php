<?php

require_once("config.php");

class Connection{
    private static $connection = null;

    public function __construct(){}

    static public function connection(){
        if (self::$connection === null) {
            try {
                $data = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8";
                self::$connection = new PDO($data, DB_USERNAME, DB_PASSWORD);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Agregado para manejar excepciones
            } catch (PDOException $e) {
                $message = array(
                    "COD" => "000",
                    "MSN" => ($e)
                );
                echo ($e->getMessage());
            }
        }
        return self::$connection;
    }

    static public function lastInsertId() {
        return self::connection()->lastInsertId();
    }
}
?>
