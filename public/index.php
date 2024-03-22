<?php

require "../vendor/autoload.php";

$router = new Core\Router();



// Add more routes as needed

//add routers for api connection
$router->addRoute('POST','/api/openai/send','Prompt@process');
$router->handleRequest();