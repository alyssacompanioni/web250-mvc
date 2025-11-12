<?php 
/**
 * -------------------------------------
 * Web250 MVC - Public Front Controller
 * -------------------------------------
 */

declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require __DIR__ . '/../vendor/autoload.php';

use web250\mvc\Controllers\HomeController;

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/';

if($path === '/' || $path === '/home') {
  echo (new HomeController())->index();
} else {
  http_response_code(404);
  echo '<h1>404 Not Found</h1>';
}
