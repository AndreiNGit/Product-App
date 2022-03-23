<?php

class Database 
{
    //left for testing
    private const HOST = "localhost";
    private const USERNAME = "root";
    private const PASSWORD = "";
    protected $conn;

    private function connect(){
        try {
            $this->conn = new PDO('mysql:host='. self::HOST .';port=3306;dbname=app', self::USERNAME, self::PASSWORD);
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