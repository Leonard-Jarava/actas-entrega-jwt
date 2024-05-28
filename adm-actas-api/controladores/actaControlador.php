<?php

namespace controladores;

require_once './db/consultas/actas/acta.php';

use db\consultas\actas\Acta;

class actaControlador
{
    public function crear($request)
    {
        $acta = new Acta();

        $errors = [];

        if (empty($request['titulo'])) {
            $errors['titulo'] = 'El título del acta es obligatorio.';
        }

        if (empty($request['fecha'])) {
            $errors['fecha'] = 'La fecha del acta es obligatoria.';
        }

        if (empty($request['hora'])) {
            $errors['hora'] = 'La hora del acta es obligatoria.';
        }

        if (empty($request['compromisos'])) {
            $errors['compromisos'] = 'Los compromisos del acta son obligatorios.';
        }

        if (empty($request['reunion_id'])) {
            $errors['reunion_id'] = 'El ID de la reunión es obligatorio.';
        }

        if (!is_numeric($request['reunion_id'] || $request['reunion_id'] <= 0)) {
            $errors['reunion_id'] = 'El ID de la reunión debe ser un número.';
        }

        if (!empty($errors)) {
            
            http_response_code(400); 

            return json_encode([
                'status' => 'error',
                'message' => 'Error en la validación de datos.',
                'errors' => $errors
            ]);
        }


        $acta->setTitulo($request['titulo']);
        $acta->setFecha($request['fecha']);
        $acta->setHora($request['hora']);
        $acta->setCompromisos($request['compromisos']);
        $acta->setReunionId($request['reunion_id']);

        if (!$acta->insert()) {

            http_response_code(500);

            return json_encode([
                'status' => 'error',
                'message' => 'Error al crear el acta'
            ]);
        }

        http_response_code(200);

        return json_encode([
            'status' => 'success',
            'message' => 'Acta creada'
        ]);
    }

    public function leer()
    {
        $acta = new Acta();

        $acta = $acta->getAll();

        http_response_code(200);

        return json_encode([
            'status' => 'success',
            'message' => 'Acta obtenida',
            'actas' => $acta
        ]);
    }

    public function actualizar($request)
    {
        $acta = new Acta();

        $acta->setId($request['id']);
        $acta->setTitulo($request['titulo']);
        $acta->setFecha($request['fecha']);
        $acta->setHora($request['hora']);
        $acta->setCompromisos($request['compromisos']);
        $acta->setReunionId($request['reunion_id']);

        if (!$acta->update()) {

            http_response_code(400);

            return json_encode([
                'status' => 'error',
                'message' => 'No se pudo actualizar el acta'
            ]);
        }

        http_response_code(200);

        return json_encode([
            'status' => 'success',
            'message' => 'Acta actualizada'
        ]);
    }

    public function eliminar($id)
    {
        $acta = new Acta();

        $acta->setId($id);

        if (!$acta->delete()) {

            http_response_code(400);

            return json_encode([
                'status' => 'error',
                'message' => 'No se pudo eliminar el acta'
            ]);
        }

        http_response_code(200);

        return json_encode([
            'status' => 'success',
            'message' => 'Acta eliminada'
        ]);
    }
}
