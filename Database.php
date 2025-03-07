<?php

class Database
{
    private static $instance = null;
    private $pdo;

    private function __construct()
    {
        $config = require("dbLogin.php");

        try {
            $this->pdo = new PDO(
                "mysql:host={$config["host"]};dbname={$config["dbname"]};charset=utf8",
                $config["username"],
                $config["password"]
            );

            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            exit("Chyba pripojeni:" . $e->getMessage());
        }
    }
    //Singletton pattern- setri zdroje jedno pripojeni k databazi pouziyi: Database::getInstance odkudkoliv
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->pdo;
    }
}
