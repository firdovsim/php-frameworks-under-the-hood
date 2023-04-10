<?php

use App\Framework\Router;

require dirname(__DIR__) .'/vendor/autoload.php';

$url = trim($_SERVER['REQUEST_URI'], '/');

Router::add('', ['controller' => 'DefaultController', 'action' => 'index']);
Router::add('posts', ['controller' => 'PostsController', 'action' => 'index']);
Router::add('posts/create', ['controller' => 'PostsController', 'action' => 'create']);

if (Router::matchRoute($url)) {
    debug(Router::getRoute());
} else {
    echo '404 - doesnt match';
}