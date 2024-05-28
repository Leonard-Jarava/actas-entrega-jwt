<?php

namespace controladores;


require_once './seguridad/jwt.php';
require_once './seguridad/tokens.php';
require_once './db/consultas/autenticacion/credenciales.php';
require_once './db/consultas/usuarios/usuario.php';

use db\consultas\autenticacion\Credenciales;
use seguridad\Jwt;
use seguridad\Tokens;
use db\consultas\usuarios\Usuario;

class AutenticacionControlador
{

    private Tokens $tokens;

    public function __construct()
    {
        $this->tokens = new Tokens($_ENV['SECRET_KEY']);
    }

    public function refresh($request)
    {
        if (!array_key_exists('refresh_token', $request)) {
            http_response_code(401);

            return json_encode([
                'status' => 'error',
                'message' => 'Token de refresco no enviado'
            ]);
        }

        $jwt = new Jwt($_ENV['SECRET_KEY']);

        $refreshToken = $request['refresh_token'];

        try {
            $payload = $jwt->decode($refreshToken);
        } catch (\Exception $e) {
            http_response_code(401);

            return json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }

        $existsRefreshToken = $this->tokens->exists($refreshToken);

        if (!$existsRefreshToken) {
            http_response_code(401);

            return json_encode([
                'status' => 'error',
                'message' => 'Token de refresco inválido'
            ]);
        }

        $user_id = $payload['sub'];

        $user = new Usuario();

        $user->setId($user_id);

        $user = $user->getOne();

        if (!$user) {
            http_response_code(401);

            return json_encode([
                'status' => 'error',
                'message' => 'Autenticación invalida'
            ]);
        }

        $this->tokens->delete($refreshToken);

        $access_token = $jwt->encode([
            'sub' => $payload['sub'],
            'name' => $user['nombre'],
            'exp' => time() + 20
        ]);

        $refresh_token_expiry = time() + 432000;

        $refresh_token = $jwt->encode([
            'sub' => $payload['sub'],
            'exp' => $refresh_token_expiry
        ]);

        $this->tokens->create($refresh_token, $refresh_token_expiry);

        http_response_code(200);

        return json_encode([
            'sub' => $payload['sub'],
            'access_token' => $access_token,
            'refresh_token' => $refresh_token
        ]);
    }

    public function login($request)
    {
        $credenciales = new Credenciales();

        $credenciales->setEmail($request['username']);
        $credenciales->setPassword($request['password']);

        $user = $credenciales->login();

        if (!$user) {

            http_response_code(401);

            return json_encode([
                'status' => 'error',
                'message' => 'Usuario no encontrado o contraseña incorrecta'
            ]);
        }

        $payload = [
            'sub' => $user['id'],
            'name' => $user['nombre'],
            'exp' => time() + 20
        ];

        $jwt = new Jwt($_ENV['SECRET_KEY']);

        $access_token = $jwt->encode($payload);

        $refresh_token_expiry = time() + 432000;

        $refresh_token = $jwt->encode([
            'sub' => $user['id'],
            'exp' => $refresh_token_expiry
        ]);

        $this->tokens->create($refresh_token, $refresh_token_expiry);

        http_response_code(200);

        return json_encode([
            'access_token' => $access_token,
            'refresh_token' => $refresh_token
        ]);
    }
}
