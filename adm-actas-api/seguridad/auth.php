<?php

namespace seguridad;

require_once './seguridad/jwt.php';

use seguridad\Jwt;

class Auth
{

    public function __construct(
        private Jwt $jwt
    ) {
    }

    public function checkJwtToken(): bool
    {
        if (!isset($_SERVER['HTTP_AUTHORIZATION'])) {
            http_response_code(401);
            echo json_encode([
                'status' => 'error',
                'message' => 'No autorizado'
            ]);
            return false;
        }

        $token = str_replace('Bearer ', '', $_SERVER['HTTP_AUTHORIZATION']);

        try {
            $this->jwt->decode($token);
        } catch (\Exception $e) {
            http_response_code(401);
            echo json_encode([
                'status' => 'error',
                'message' => 'No autorizado'
            ]);
            return false;
        }

        return true;
    }
}
