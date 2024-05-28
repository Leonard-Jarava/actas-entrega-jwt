<?php 

namespace seguridad;

require_once './db/connection.php';

use db\Conecction;
use PDO;

class Tokens
{
    private PDO $conn;
    
    public function __construct(
        private string $secretKey
        )
    {
        $this->conn = (new Conecction())->getConn();
    }

    public function create(string $token, int $expiry): bool
    {
        $hash = hash_hmac("sha256", $token, $this->secretKey);
        
        $query = "INSERT INTO refresh_token (token_hash, expires_at) 
                    VALUES (:token_hash, :expires_at)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':token_hash', $hash);
        $stmt->bindParam(':expires_at', $expiry);

        return $stmt->execute();
    }

    public function delete(string $token): int
    {
        $hash = hash_hmac("sha256", $token, $this->secretKey);
        
        $query = "DELETE FROM refresh_token WHERE token_hash = :token_hash";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':token_hash', $hash);
        $stmt->execute();

        return $stmt->rowCount();
    }

    public function exists(string $token): bool
    {
        $hash = hash_hmac("sha256", $token, $this->secretKey);
        
        $query = "SELECT 1 FROM refresh_token WHERE token_hash = :token_hash";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':token_hash', $hash);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    public function deleteExpired(): int
    {
        $query = "DELETE FROM refresh_token WHERE expiry_at < UNIX_TIMESTAMP()";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->rowCount();
    }
}