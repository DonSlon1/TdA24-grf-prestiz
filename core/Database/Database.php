<?php

namespace Core\Database;

use PDO;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

class Database
{
    private readonly string $host;
    private readonly string $db;
    private readonly string $password;
    private readonly string $user;
    private readonly string $charset;
    private readonly string $dns;
    private PDO $pdo;


    public function __construct()
    {
        $this->host = getenv('MYSQL_PHP_HOST') ? getenv('MYSQL_PHP_HOST') : '127.0.0.1';
        $this->db = getenv('MYSQL_DATABASE') ? getenv('MYSQL_DATABASE') : 'db';
        $this->password = getenv('MYSQL_ROOT_PASSWORD') ? getenv('MYSQL_ROOT_PASSWORD') : 'root';
        $this->user = getenv('MYSQL_USER') ? getenv('MYSQL_USER') : 'root';
        $this->charset = getenv('MYSQL_CHARSET') ? getenv('MYSQL_CHARSET') : 'utf8mb4';
        $this->dns = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        $this->pdo = new PDO($this->dns, $this->user, $this->password);

    }

    public function select(string $sql, array $params = []): array
    {
        $stmt = $this->pdo->prepare($sql);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function execute(string $sql, array $params = []): bool
    {
        $stmt = $this->pdo->prepare($sql);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        return $stmt->execute($params);
    }

    public function beginTransaction()
    {
        return $this->pdo->beginTransaction();
    }

    public function commit()
    {
        return $this->pdo->commit();
    }

    public function rollback()
    {
        return $this->pdo->rollback();
    }

    public function getPdo(): PDO
    {
        return $this->pdo;
    }

    /**
     * @return string
     */
    public function getDb(): string
    {
        return $this->db;
    }

    /**
     * @return string
     */
    public function getUser(): string
    {
        return $this->user;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

}