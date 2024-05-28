<?php

namespace controladores;

require_once './db/consultas/asistencias/asistencia.php';

use db\consultas\asistencias\Asistencia;

class AsistenciaControlador
{
    public function crear($request)
    {
        $asistencia = new Asistencia();

        $asistencia->setUserId($request['usuario_id']);
        $asistencia->setReunionId($request['reunion_id']);
        $asistencia->setHoraIngreso(date("Y-m-d H:i:s"));

        $asistencia->insert();

        http_response_code(200);

        return json_encode([
            'status' => 'success',
            'message' => 'asistencia registrada'
        ]);
    }

    public function leer()
    {
        $id = $_GET['id'];

        $asistencia = new Asistencia();

        $asistencia->setReunionId($id);

        $asistencias = $asistencia->getAll();

        http_response_code(200);

        return json_encode([
            'status' => 'success',
            'asistencias' => $asistencias
        ]);     
    }

    public function eliminar()
    {
        $asistencia = new Asistencia();

        $reunionId = $_GET['reunionId'];
        $usuarioId = $_GET['usuarioId'];

        $asistencia->setReunionId($reunionId);
        $asistencia->setUserId($usuarioId);        

        $asistencia->delete();

        http_response_code(200);

        return json_encode([
            'status' => 'success',
            'message' => 'asistencia eliminada'
        ]);
    }
}
