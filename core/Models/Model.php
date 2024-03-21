<?php

namespace Core\Models;

use Core\Database\Database;
use Core\Entities\EntitiesManager;
use Doctrine\ORM\EntityManager;
use PDO;

readonly class Model
{
    protected PDO $pdo;
    protected Database $database;
    protected EntityManager $entityManager;

    protected function __construct(
        EntitiesManager $entityManagerInterface
    )
    {
        $this->database = $entityManagerInterface->getDatabase();
        $this->pdo = $this->database->getPdo();
        $this->entityManager = $entityManagerInterface->getEntityManager();
    }

    /**
     * @return Database
     */
    public function getDatabase(): Database
    {
        return $this->database;
    }

    /**
     * @return PDO
     */
    public function getPdo(): PDO
    {
        return $this->pdo;
    }

    /**
     * @return EntityManager
     */
    public function getEntityManager(): EntityManager
    {
        return $this->entityManager;
    }


    /**
     * @template T of Model
     * @param class-string<T> $class
     * @return T
     */
    public static function createModel(string $class)
    {
        $entityManager = new EntitiesManager(new Database());
        return new $class($entityManager);
    }
}