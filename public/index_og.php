<?php
 // public/index.php 
  // 
  // This is the FRONT CONTROLLER. 
  // Every request from the browser comes to this file first. 
  // It will: 
  //  1. Turn on error reporting (for development). 
  //  2. Load the Router and the Controller class. 
  //  3. Register routes (which URL  which action). 
  //  4. Ask the router to dispatch the current request.

declare(strict_types=1);

// Show errors while we are learning (in production, this should be turned off)
ini_set('display_errors', '1');
error_reporting(E_ALL);

// Load the Router and the SalamanderController class
require_once __DIR__ . '/../src/Router.php';
require_once __DIR__ . '/../src/Controllers/SalamanderController.php';

// Create a Router instance
$router = new Router();

// Register a route for the home page ("/")
$router->get('/', function () {
  // This callback is called when the browser requests "/salamanders"
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
