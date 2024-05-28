<?php

namespace db\consultas\reuniones;

require_once './db/connection.php';

use db\Conecction;
use PDO;    

class Reunion
{

    private $conn;

    private $id;
    private $nombre;
    private $fecha;
    private $hora;
    private $lugar;
    private $descripcion;

    public function __construct()
    {
        $this->conn = (new Conecction())->getConn();
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function setHora($hora)
    {
        $this->hora = $hora;
    }

    public function getHora()
    {
        return $this->hora;
    }

    public function setLugar($lugar)
    {
        $this->lugar = $lugar;
    }

    public function getLugar()
    {
        return $this->lugar;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getAll()
    {
        $stmt = $this->conn->prepare("SELECT * FROM reuniones");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert()
    {
        $stmt = $this->conn->prepare("INSERT INTO reuniones (nombre, fecha, hora, lugar, descripcion) VALUES (:nombre, :fecha, :hora, :lugar, :descripcion)");
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':fecha', $this->fecha);
        $stmt->bindParam(':hora', $this->hora);
        $stmt->bindParam(':lugar', $this->lugar);
        $stmt->bindParam(':descripcion', $this->descripcion);
        return $stmt->execute();
    }

    public function update()
    {
        $stmt = $this->conn->prepare("UPDATE reuniones SET nombre = :nombre, fecha = :fecha, hora = :hora, lugar = :lugar, descripcion = :descripcion WHERE id = :id");
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':fecha', $this->fecha);
        $stmt->bindParam(':hora', $this->hora);
        $stmt->bindParam(':lugar', $this->lugar);
        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }

    public function delete()
    {
        $stmt = $this->conn->prepare("DELETE FROM reuniones WHERE id = :id");
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }
}
