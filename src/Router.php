<?php

declare(strict_types=1);

namespace Web250\Mvc;

/**
 * -----------------------------------------------------------------------------------
 * Tiny Router (Exact-Match Version)
 * -----------------------------------------------------------------------------
 * WHAT THIS DOES:
 *  Lets us register GET routes like $router->get('/', handler)
 *  Matches the current request path to a handler
 *  Calls the handler and echoes its return value
 * 
 * WHAT THIS DOES NOT:
 *  A full framework router (no middleware, no named routes, etc.)
 *  It only supports exact path matches for now (no /posts/{id} yet) * 
 */

final class Router
{
  private array $routes = [];

  /** Register a GET route */
  public function get(string $path, callable $handler): void 
  {
    $this->routes['GET'][$path] = $handler;
  }

  public function dispatch(string $method, string $path): void 
  {
    $handler = $this->routes[$method][$path] ?? null;

    if(!$handler) {
      http_response_code(404);
      echo '<h1>404 Not Found</h1>';
      // NOTE - the next 2 lines is supposed to be one line
      echo '<p>No route registered for: ' . htmlspecialchars($path, ENT_QUOTES, 'UTF-8') . '</p>';
      return;
    }

    echo $handler();
  }
}
