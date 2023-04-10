<?php

namespace App\Framework;

class Router
{
    const NAMESPACE = 'App\Controllers';
    protected static array $routes;
    protected static array $route;

    public static function add(string $regexp, array $route = []): void
    {
        self::$routes[$regexp] = $route;
    }

    public static function getRoutes(): array
    {
        return self::$routes;
    }

    public static function getRoute(): array
    {
        return self::$route;
    }

    public static function matchRoute($url): bool
    {
        foreach (self::getRoutes() as $regexp => $route) {
            if ($url === $regexp) {
                self::$route = $route;

                return true;
            }
        }

        return false;
    }

    public static function matchActionRoute(string $url): bool
    {
        foreach (self::getRoutes() as $regexp => $route) {
            if (preg_match("#$regexp#", $url, $matches)) {
                foreach ($matches as $key => $match) {
                    if(is_string($key)) {
                        $route[$key] = $match;
                    }
                }

                if (!isset($route['action'])) {
                    $route['action'] = 'index';
                }

                self::$route = $route;

                return true;
            }
        }

        return false;
    }

    public static function dispatch($url): void
    {
        if (self::matchActionRoute($url)) {
            $controller = self::getUpperCamelCaseController(self::$route['controller']);
            $action = self::getLowerCamelCaseController(self::$route['action']);

            if (class_exists($controller)) {
                $object = new $controller();
                if (method_exists($object, $action)) {
                    $object->$action();
                } else {
                    echo "Method $controller::$action not found";
                }
            } else {
                echo "{$controller} doesnt exist";
            }
        } else {
            http_response_code(404);
            echo '404 - doesnt match';
        }
    }

    private static function getUpperCamelCaseController(string $controller): string
    {
        // handling posts-views controller -> App\Controllers\PostsViewsController
        $controller = str_replace('-', ' ', $controller);
        $controller = ucwords($controller);
        $controller = str_replace(' ', '', $controller);

        return sprintf("%s\%sController", self::NAMESPACE, $controller);
    }

    private static function getLowerCamelCaseController(string $action): string
    {
        // handling posts-views controller -> App\Controllers\PostsViewsController
        $action = str_replace('-', ' ', $action);
        $action = ucwords($action);
        $action = str_replace(' ', '', $action);

        return sprintf("%sAction",  lcfirst($action));
    }
}