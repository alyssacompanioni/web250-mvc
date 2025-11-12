<?php
declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require __DIR__ . '/../vendor/autoload.php';

use Web250\Mvc\Router;
use Web250\Mvc\Controllers\HomeController;

$router = new Router();
$router->get('/', fn() => (new HomeController())->index());
$router->get('/home', fn() => (new HomeController())->index());
$router->get('/about', fn() => '<h1>About</h1><p>This route is handled by a closure.</p>');

// --- NEW: compute path relative to /public ---
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$uri    = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/';

// figure out the public folder’s web path (e.g. /web-250-mvc/public)
$base   = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '')), '/');

// strip the base from the URI so routes like "/" and "/about" work anywhere
$path   = '/' . ltrim(preg_replace('#^' . preg_quote($base, '#') . '#', '', $uri), '/');
if ($path === '//') { $path = '/'; }

// dispatch
$router->dispatch($method, $path);
