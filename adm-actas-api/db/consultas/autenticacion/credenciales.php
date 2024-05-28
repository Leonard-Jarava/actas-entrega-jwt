<?php

namespace db\consultas\autenticacion;

require_once './db/connection.php';

use db\Conecction;
use PDO;

class Credenciales
{

    private $conn;

    private $email;
    private $password;

    public function __construct()
    {
        $this->conn = (new Conecction())->getConn();
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getUserByEmail()
    {
        $query = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function verifyPassword($password, $hash)
    {
        return password_verify($password, $hash);
    }

    public function login()
    {
        $user = $this->getUserByEmail();
        
        if (!$user) {
            return false;
        }

        if (!$this->verifyPassword($this->password, $user['password'])) {
            return false;
        }

        return $user;
    }

}