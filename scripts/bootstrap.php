<?php
// bootstrap.php
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

require_once __DIR__ . "/../vendor/autoload.php";

// Create a simple "default" Doctrine ORM configuration for Attributes
$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: array(__DIR__ . "/../app/Entities"),
);
// or if you prefer XML
// $config = ORMSetup::createXMLMetadataConfiguration(
//    paths: array(__DIR__."/config/xml"),
//    isDevMode: true,
//);
// configuring the database connection
$connection = DriverManager::getConnection([
    'driver' => 'pdo_mysql',
    'user' => getenv('MYSQL_USER') ? getenv('MYSQL_USER') : 'root',
    'password' => getenv('MYSQL_ROOT_PASSWORD') ? getenv('MYSQL_ROOT_PASSWORD') : '',
    'dbname' => getenv('MYSQL_DATABASE') ? getenv('MYSQL_DATABASE') : 'db',
    'host' => getenv('MYSQL_PHP_HOST') ? getenv('MYSQL_PHP_HOST') : '127.0.0.1',
], $config);

// obtaining the entity manager
$entityManager = new EntityManager($connection, $config);