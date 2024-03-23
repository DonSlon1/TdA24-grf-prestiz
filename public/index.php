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
$router->addRoute('GET','/api/activity','Activity@getAll');
$router->addRoute('GET','/api/activity/{uuid}','Activity@get');
$router->addRoute('DELETE','/api/activity/{uuid}','Activity@delete');

//activity routes for frontend
$router->addRoute('GET', '/aktivita', 'Activities@singleActivity');
$router->addRoute('GET','/aktivita/{uuid}', 'Activities@singleActivity');

// Add more routes as needed

//add routers for open api connection
$router->addRoute('POST','/api/openai/send','Prompt@process');
$router->handleRequest();