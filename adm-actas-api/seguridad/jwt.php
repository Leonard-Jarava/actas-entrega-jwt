<?php

namespace seguridad;

use Exception;

class Jwt
{
    private static $algorithm = 'sha256';

    public function __construct(
        private string $secretKey
    ) {
    }

    public function encode(array $payload): string
    {
        $header = $this->base64URLEncode(
            json_encode(['typ' => 'JWT', 'alg' => self::$algorithm])
        );

        $payload = $this->base64URLEncode(
            json_encode($payload)
        );
        
        $signature = $this->base64URLEncode(
            hash_hmac(self::$algorithm, "$header.$payload", $this->secretKey, true)
        );

        return "$header.$payload.$signature";
    }
    
    public function decode(string $token): array
    {
        if(preg_match("/^(?<header>.+)\.(?<payload>.+)\.(?<signature>.+)$/", $token, $matches) !== 1) 
        {
            throw new \Exception('Token no válido');    
        }
        
        $signature = hash_hmac(
            self::$algorithm, 
            "$matches[header].$matches[payload]", 
            $this->secretKey, 
            true
        );

        $signatureFromToken = $this->base64URLDecode($matches['signature']);

        if(!hash_equals($signature, $signatureFromToken)){
            throw new Exception('Token no válido');
        }

        $payload = json_decode($this->base64URLDecode($matches['payload']), true);

        if($payload['exp'] < time()){
            throw new Exception('Token expirado');
        }

        return $payload;
    }
    

    private function base64URLEncode($text): string
    {
        return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($text));
    }

    private function base64URLDecode($text): string
    {
        return base64_decode(str_replace(
            ['-', '_'], 
            ['+', '/'], 
            $text
        ));
    }
}
