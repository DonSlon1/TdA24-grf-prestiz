<?php

require "../vendor/autoload.php";

$router = new Core\Router();
$db = new \Core\Database\Database();


$router->addRoute('POST', '/login', 'Auth@login');
$router->addRoute('GET', '/logout', 'Auth@logout');
$router->addRoute('GET', '/api', 'Api@get');


$router->addRoute('GET', '/lektori', 'Lektor@index');
$router->addRoute('GET', '/api/lecturers/cards/', 'Lektor@lectorCards');
$router->addRoute('GET', '/lektori/{uuid}', 'Lektor@viewOne');
$router->addRoute('GET', '/', 'Home@index');
$router->addRoute('GET', "/gdpr", 'Privacy@gdpr');
$router->addRoute('GET', "/soukromi", 'Privacy@privacy');
$router->addRoute('GET', "/o-nas", 'Privacy@about');
$router->addRoute('GET', "/login", 'Login@login');
$router->addRoute('GET', "/lektor/interface", 'Login@interface', true);
$router->addRoute('GET', "/lektor/interface/{uuid}", 'Login@meetinginfo', true);
$router->addRoute('GET', "/lektori/{uuid}/rezervace", 'Meeting@meeting');
$router->addRoute('GET', "/lektori/{uuid}/rezervace/potvrzeni", 'Meeting@success');


// Reservation routes
$router->addRoute('GET', '/api/reservation/{uuid}', 'Reservation@getOne');
$router->addRoute('POST', '/api/reservation', 'Reservation@create');
$router->addRoute('PUT', '/api/reservation/{uuid}', 'Reservation@update');
$router->addRoute('DELETE', '/api/reservation/{uuid}', 'Reservation@delete');
$router->addRoute('GET', '/api/reservation', 'Reservation@getAll');

// Lektor routes
$router->addRoute('GET', '/api/lecturers/{uuid}/available-slots', 'Reservation@getAvailableSlots');
$router->addRoute('GET', '/api/lecturers/{uuid}/reservations', 'Reservation@getAllForLektor');
$router->addRoute('GET', '/api/lecturers/{uuid}/export-to-ical', 'Reservation@exportToIcalendar');

// Auth routes
$router->addRoute('GET', '/api/lecturers', 'Lektor@get', apiAuth: true);
$router->addRoute('POST', '/api/lecturers', 'Lektor@post', apiAuth: true);
$router->addRoute('PUT', '/api/lecturers/{uuid}', 'Lektor@put', apiAuth: true);
$router->addRoute('DELETE', '/api/lecturers/{uuid}', 'Lektor@delete', apiAuth: true);
$router->addRoute('GET', '/api/lecturers/{uuid}', 'Lektor@getOne', apiAuth: true);

// Add more routes as needed

$router->handleRequest();