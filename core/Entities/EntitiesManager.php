<?php

namespace Core\Entities;

use Core\Database\Database;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

readonly class EntitiesManager
{
    private EntityManager $entityManager;

    public function __construct(
        private Database $database
    )
    {
        $dbParams = [
            'driver' => 'pdo_mysql',
            'user' => $this->database->getUser(),
            'password' => $this->database->getPassword(),
            'dbname' => $this->database->getDb(),
            'host' => $this->database->getHost(),
        ];
        $config = ORMSetup::createAttributeMetadataConfiguration([dirname($_SERVER['DOCUMENT_ROOT']) . '/app/Entities/'], true);
        $connection = DriverManager::getConnection($dbParams, $config);
        $this->entityManager = new EntityManager($connection, $config);
    }

    /**
     * @return Database
     */
    public function getDatabase(): Database
    {
        return $this->database;
    }

    public function getEntityManager(): EntityManager
    {
        return $this->entityManager;
    }
}