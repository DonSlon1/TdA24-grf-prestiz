<?php

require "../vendor/autoload.php";

$router = new Core\Router();
$router->addRoute('GET', "/chat", 'ChatInterface@chat');
$router->addRoute('GET', '/', 'Home@index');

//login routes
$router->addRoute('GET','/login','Login@login');
$router->addRoute('POST','/login','Auth@login');
// Add more routes as needed

//add routers for open api connection
$router->addRoute('POST','/api/openai/send','Prompt@process');
$router->handleRequest();