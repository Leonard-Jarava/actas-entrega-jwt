<?php

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/rutas.php';

require_once './seguridad/auth.php';
require_once './seguridad/jwt.php';

use seguridad\Auth;
use seguridad\Jwt;

$jwt = new Jwt($_ENV['SECRET_KEY']);

$auth = new Auth($jwt);

$uri = ltrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

$uriParts = explode('/', $uri);

$nombrecontrolador = $rutas[$uriParts[0]]['controlador'];

$accion = $uriParts[1];

$id =  isset($uriParts[2]) ? $uriParts[2] : null;

$archivoControlador = 'controladores/' . $nombrecontrolador . '.php';

if (!file_exists($archivoControlador)) {

    http_response_code(404);

    echo json_encode([
        'status' => 'error',
        'message' => 'Controlador no encontrado'
    ]);

    exit;
}

require_once $archivoControlador;

$nombreClase = 'controladores\\' . $nombrecontrolador;

$controlador = new $nombreClase();

if (!method_exists($controlador, $uriParts[1])) {

    http_response_code(404);

    echo json_encode([
        'status' => 'error',
        'message' => 'Método no encontrado'
    ]);

    exit;
}

$accionControlador = $rutas[$uriParts[0]]['acciones'][$accion];

if($accionControlador['autenticacion']){
    if(!$auth->checkJwtToken()){
        exit;
    }
}

if ($accionControlador['metodoHttp'] !== $metodoHttp) {

    http_response_code(405);

    echo json_encode([
        'status' => 'error',
        'message' => 'Método no permitido',
        'metodo' => $metodoHttp,    
        'esperado' => $accionControlador['metodoHttp']
    ]);

    exit;
}

$request = json_decode(file_get_contents('php://input'), true);

if ($metodoHttp == 'DELETE') {
    echo $controlador->$accion($id);
    exit;
}


echo $controlador->$accion($request, $id);
