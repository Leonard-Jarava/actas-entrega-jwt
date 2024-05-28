<?php

namespace db\consultas\actas;

require_once './db/connection.php';

use db\Conecction;
use PDO;

class Acta 
{
    private $conn;

    private $id;
    private $titulo;
    private $fecha;
    private $hora;
    private $compromisos;
    private $reunionId;

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

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    public function getTitulo()
    {
        return $this->titulo;
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

    public function setCompromisos($compromisos)
    {
        $this->compromisos = $compromisos;
    }

    public function getCompromisos()
    {
        return $this->compromisos;
    }

    public function setReunionId($reunionId)
    {
        $this->reunionId = $reunionId;
    }

    public function getReunionId()
    {
        return $this->reunionId;
    }

    public function getAll()
    {
        $query = "SELECT * FROM actas";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOne()
    {
        $query = "SELECT * FROM actas WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $this->id);

        $stmt->execute();

        return $stmt->fetch();
    }

    public function insert()
    {
        $query = "INSERT INTO actas (titulo, fecha, hora, compromisos, reunion_id) VALUES (:titulo, :fecha, :hora, :compromisos, :reunion_id)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':titulo', $this->titulo);
        $stmt->bindParam(':fecha', $this->fecha);
        $stmt->bindParam(':hora', $this->hora);
        $stmt->bindParam(':compromisos', $this->compromisos);
        $stmt->bindParam(':reunion_id', $this->reunionId);

        return $stmt->execute();
    }

    public function update()
    {
        $query = "UPDATE actas SET titulo = :titulo, fecha = :fecha, hora = :hora, compromisos = :compromisos, reunion_id = :reunion_id WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':titulo', $this->titulo);
        $stmt->bindParam(':fecha', $this->fecha);
        $stmt->bindParam(':hora', $this->hora);
        $stmt->bindParam(':compromisos', $this->compromisos);
        $stmt->bindParam(':reunion_id', $this->reunionId);
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }

    public function delete()
    {
        $query = "DELETE FROM actas WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }

}

