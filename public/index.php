<?php

require "../vendor/autoload.php";

$router = new Core\Router();
$router->addRoute('GET', "/chat", 'ChatInterface@chat');
$router->addRoute('GET', "/aktivity", 'Activities@allActivities');
$router->addRoute('GET', '/', 'Home@index');

//login routes
$router->addRoute('GET','/admin','Login@login');
$router->addRoute('GET','/admin/interface','Login@interface');
$router->addRoute('POST','/login','Auth@login');
$router->addRoute('GET', '/logout', 'Auth@logout');


//activity api routes
$router->addRoute('POST','/api/activity','Activity@post');
$router->addRoute('GET', '/aktivita', 'Activities@singleActivity');

// Add more routes as needed

//add routers for open api connection
$router->addRoute('POST','/api/openai/send','Prompt@process');
$router->handleRequest();