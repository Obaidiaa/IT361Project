<?php


$url = parse_url(($_SERVER['REQUEST_URI']))['path'];


$routes = [
    '/' => 'controllers/index.php',
    '/members' => 'controllers/members.php',
    '/instructors' => 'controllers/instructors.php',
    '/equipment' => 'controllers/equipment.php',
    '/about' => 'controllers/about.php'
];

function routeToController($url, $routes)
{
    if (array_key_exists(($url), $routes)) {
        require $routes[$url];
    } else {
        abort();
    }
}

function abort($code = 404)
{
    http_response_code($code);

    require "views/{$code}.php";

    die();
}

routeToController($url, $routes);
