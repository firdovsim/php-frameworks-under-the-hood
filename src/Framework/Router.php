<?php

namespace App\Framework;

class Router
{
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
}