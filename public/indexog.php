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

// Figure out which path the user requested, ignoring the query string
// Example: "/salamanders?page=2" becomes "/salamanders"
$uriPath = parse_url($SERVER)
