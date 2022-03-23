<?php

class Database 
{
    //left for testing
    private const HOST = "localhost";
    private const USERNAME = "tacapaca_andreeinn";
    private const PASSWORD = "Productapp1";
    protected $conn;

    private function connect(){
        try {
            $this->conn = new PDO('mysql:host='. self::HOST .';dbname=tacapaca_productapp', self::USERNAME, self::PASSWORD);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e)
        {
            echo "Failed to connect! Error: " . $e->getMessage();
        }
    }

    public function getConn()
    {
        return $this->conn;
    }

    function __construct()
    {
        $this->connect();
    }
}