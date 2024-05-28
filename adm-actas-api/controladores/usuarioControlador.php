<?php

namespace controladores;

require_once './db/consultas/usuarios/usuario.php';

use db\consultas\usuarios\Usuario;

class UsuarioControlador
{

    public function crear($request)
    {
        $usuario = new Usuario();

        $usuario->setNombre($request['nombre']);
        $usuario->setApellido($request['apellido']);
        $usuario->setEmail($request['email']);
        $usuario->setPassword($request['password']);

        if(!$usuario->insert()) {

            http_response_code(400);

            return json_encode([
                'status' => 'error',
                'message' => 'No se pudo crear el usuario'
            ]);
        }

        http_response_code(201);

        return json_encode([
            'status' => 'success',
            'message' => 'Usuario creado'
        ]);
    }

    public function leer()
    {
        $usuario = new Usuario();

        $usuarios = $usuario->getAll();

        http_response_code(200);

        return json_encode([
            'status' => 'success',
            'usuarios' => $usuarios
        ]);
    }

    public function actualizar($request, $id)
    {
        $usuario = new Usuario();

        $usuario->setId($id);
        $usuario->setNombre($request['nombre']);
        $usuario->setApellido($request['apellido']);
        $usuario->setEmail($request['email']);
        $usuario->setPassword($request['password']);

        if(!$usuario->update()) {

            http_response_code(400);

            return json_encode([
                'status' => 'error',
                'message' => 'No se pudo actualizar el usuario'
            ]);
        }

        http_response_code(200);

        return json_encode([
            'status' => 'success',
            'message' => 'Usuario actualizado'
        ]);
    }


    public function eliminar($id)
    {
        $usuario = new Usuario();

        $usuario->setId($id);

        if(!$usuario->delete()) {

            http_response_code(400);

            return json_encode([
                'status' => 'error',
                'message' => 'No se pudo eliminar el usuario'
            ]);
        }

        http_response_code(200);

        return json_encode([
            'status' => 'success',
            'message' => 'Usuario eliminado'
        ]);
    }

    
}   