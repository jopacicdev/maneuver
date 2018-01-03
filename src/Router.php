<?php

namespace Maneuver;

class Router
{
    private $routes = [];

    public function register(string $verb, string $route, string $handler) : Router
    {
        if (!Route::isValid($verb)) {
            throw new \InvalidArgumentException("$verb is not supported");
        }

        $this->routes[] = new Route($verb, $route, $handler);

        return $this;
    }

    public function get(string $route, string $handler) : Router
    {
        $this->routes[] = new Route(Route::GET, $route, $handler);

        return $this;
    }

    public function post(string $route, string $handler) : Router
    {
        $this->routes[] = new Route(Route::POST, $route, $handler);

        return $this;
    }

    public function routeRequest()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];

        return $this->handleRequest($method, $uri);
    }

    protected function handleRequest($method, $uri)
    {
        /** @var Route $route */
        foreach ($this->routes as $route) {
            $r = rtrim($route->getRoute(), '/');

            if ($method !== $route->getVerb()) {
                continue;
            }

            if (!preg_match(sprintf("/^%s$/", preg_quote($r, '/')), $uri, $matches)) {
                continue;
            }

            $route->handle();

            return $route;
        }

        // Route not found, responding with 404
        http_response_code(404);
    }
}
