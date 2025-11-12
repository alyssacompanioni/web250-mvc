<?php 
declare(strict_types=1);

namespace web250\mvc\Models;

class Greeting {
  public function hello(): string {
    return "Hello from Web250 MVC!";
  }
}
