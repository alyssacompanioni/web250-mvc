<?php

declare(strict_types=1);

ini_set('display_errors', '1');
error_reporting(E_ALL);

require_once __DIR__ . '/../src/Router.php';
require_once __DIR__ . '/../src/Controllers/SalamanderController.php';

$router = new Router();
$router->get('/', function () {
    $controller = new SalamanderController();
    $controller->index();
});

$router->get('/salamanders', function () {
    $controller = new SalamanderController();
    $controller->index();
});

/**
 * Normalize the path so routes like "/" and "/salamanders"
 * work even when the app lives under a subfolder such as
 * /web-250-mvc/public on localhost.
 */
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

// Raw path the browser requested (no query string)
$uriPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/';

// Web path to THIS script's directory, e.g. "/web-250-mvc/public"
$base = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '')), '/');

// Strip the base prefix so "/web-250-mvc/public/" becomes "/"
$path = '/' . ltrim(preg_replace('#^' . preg_quote($base, '#') . '#', '', $uriPath), '/');

// Normalize trailing double slashes -> "/"
if ($path === '//') { $path = '/'; }
$router->dispatch($path, $method);
