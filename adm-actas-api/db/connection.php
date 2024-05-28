<?php

namespace db;

use PDO;

class Conecction {
    
    private $conn;
    private $host = "localhost";
    private $database = "actas_db";

    private $user = "root";
    private $password = "";

    public function __construct() {
        $this->conn = new PDO("mysql:host=$this->host;dbname=$this->database", $this->user, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getConn() {
        return $this->conn;
    }

}