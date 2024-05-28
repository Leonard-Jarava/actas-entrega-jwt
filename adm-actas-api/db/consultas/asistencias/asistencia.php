<?php

namespace db\consultas\asistencias;

require_once './db/connection.php';

use db\Conecction;
use PDO;

class Asistencia
{
    private $conn;

    private $userId;
    private $reunionId;
    private $horaIngreso;

    public function __construct()
    {
        $this->conn = (new Conecction())->getConn();
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setReunionId($reunionId)
    {
        $this->reunionId = $reunionId;
    }

    public function getReunionId()
    {
        return $this->reunionId;
    }

    public function setHoraIngreso($horaIngreso)
    {
        $this->horaIngreso = $horaIngreso;
    }

    public function getHoraIngreso()
    {
        return $this->horaIngreso;
    }

    public function insert()
    {
        $query = "INSERT INTO asistencias (usuario_id, reunion_id, hora_ingreso) VALUES (:userId, :reunionId, :horaIngreso)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':userId', $this->userId);
        $stmt->bindParam(':reunionId', $this->reunionId);
        $stmt->bindParam(':horaIngreso', $this->horaIngreso);
        return $stmt->execute();
    }

    public function getAll()
    {
        $query = "SELECT * FROM asistencias INNER JOIN usuarios ON asistencias.usuario_id = usuarios.id WHERE reunion_id = :reunion_id
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':reunion_id', $this->reunionId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete()
    {
        $query = "DELETE FROM asistencias WHERE usuario_id = :userId AND reunion_id = :reunionId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':userId', $this->userId);
        $stmt->bindParam(':reunionId', $this->reunionId);
        return $stmt->execute();
    }


}