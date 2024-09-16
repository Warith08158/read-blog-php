<?php 
declare(strict_types=1);
include "config/db-config.php";


abstract class Database_handler
{
    private const HOSTNAME = HOSTNAME;
    private const USERNAME = USERNAME;
    private const PASSWORD = PASSWORD;
    private const DBNAME = DBNAME;

    //connect to database
    protected function connect(){

        $dsn = "mysql:host=" . self::HOSTNAME . ";dbname=" . self::DBNAME;
        $options = [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];

        try {
            return new PDO($dsn, self::USERNAME, self::PASSWORD, $options);
        } catch (\PDOException $e) {
            echo "error: " . $e->getMessage() . "(comming from /lib/Database_handler.php)";
        }

    }

    protected function query(string $sql)
    {
        return $this->connect()->query($sql);
    }

    protected function fetchAll($sql): array
    {
        return $this->query($sql)->fetchAll();
    }

    protected function fetch($sql): array
    {
        return $this->query($sql)->fetch();
    }

}