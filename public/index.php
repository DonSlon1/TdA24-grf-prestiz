<?php

require "../vendor/autoload.php";

$router = new Core\Router();


$router->addRoute('GET', '/', 'Home@index');
// Add more routes as needed

//add routers for open api connection
$router->addRoute('POST','/api/openai/send','Prompt@process');
$router->handleRequest();