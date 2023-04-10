<?php

use App\Framework\Router;

require dirname(__DIR__) .'/vendor/autoload.php';

$url = trim($_SERVER['REQUEST_URI'], '/');

Router::add('^$', ['controller' => 'Default', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');

Router::dispatch($url);