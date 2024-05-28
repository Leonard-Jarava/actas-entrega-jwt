<?php

namespace controladores;

require_once './db/consultas/reuniones/reunion.php';

use db\consultas\reuniones\Reunion;

class ReunionControlador
{

    public function crear($request)
    {
        $Reunion = new Reunion();

        $Reunion->setNombre($request['nombre']);
        $Reunion->setFecha($request['fecha']);
        $Reunion->setHora($request['hora']);
        $Reunion->setLugar($request['lugar']);
        $Reunion->setDescripcion($request['descripcion']);

        if (!$Reunion->insert()) {

            http_response_code(500);

            return json_encode([
                'status' => 'error',
                'message' => 'Error al crear el Reunion'
            ]);
        }

        http_response_code(200);

        return json_encode([
            'status' => 'success',
            'message' => 'Reunion creada'
        ]);
    }

    public function leer()
    {
        $Reunion = new Reunion();

        $Reuniones = $Reunion->getAll();

        http_response_code(200);

        return json_encode([
            'status' => 'success',
            'reuniones' => $Reuniones
        ]);
    }

    public function actualizar($request, $id)
    {
        $Reunion = new Reunion();

        $Reunion->setId($id);
        $Reunion->setNombre($request['nombre']);
        $Reunion->setFecha($request['fecha']);
        $Reunion->setHora($request['hora']);
        $Reunion->setLugar($request['lugar']);
        $Reunion->setDescripcion($request['descripcion']);

        if (!$Reunion->update()) {

            http_response_code(500);

            return json_encode([
                'status' => 'error',
                'message' => 'Error al actualizar el Reunion'
            ]);
        }

        http_response_code(200);

        return json_encode([
            'status' => 'success',
            'message' => 'Reunion actualizada'
        ]);
    }

    public function eliminar($id)
    {
        $Reunion = new Reunion();

        $Reunion->setId($id);

        if (!$Reunion->delete()) {

            http_response_code(500);

            return json_encode([
                'status' => 'error',
                'message' => 'Error al eliminar el Reunion'
            ]);
        }

        http_response_code(200);

        return json_encode([
            'status' => 'success',
            'message' => 'Reunion eliminada'
        ]);
    }
}
