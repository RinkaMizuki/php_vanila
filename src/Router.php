<?php

namespace App;

use App\Constants\Method;
use App\Extensions\MediaNotSupportException;
use App\Middlewares\IMiddleware;

class Router
{
    protected $routes = [];

    private function addRoute($route, $controller, $action, $method, $middleware)
    {
        $routeRegex = preg_replace('/:(\w+)/', '(?P<$1>[^/]+)', $route);
        /*
        [
            'get' => [['pattern' => '/^\/users\/profile\/(?P<id>[^/]+)$/', 'controller' => $controller, 'action' => $action], ...],
            'post' => [['pattern' => '/^\/user$/', 'controller' => $controller, 'action' => $action], ...],
            ...
        ]
        */
        $this->routes[$method][] = [
            'pattern' => '#^' . $routeRegex . '$#',
            'controller' => $controller,
            'action' => $action,
            'middleware' => $middleware,
        ];
    }

    public function get($route, $controller, $action, $middleware = [])
    {
        $this->addRoute($route, $controller, $action, Method::GET, $middleware);
    }

    public function post($route, $controller, $action, $middleware = [])
    {
        $this->addRoute($route, $controller, $action, Method::POST, $middleware);
    }

    public function put($route, $controller, $action, $middleware = [])
    {
        $this->addRoute($route, $controller, $action, Method::PUT, $middleware);
    }

    public function delete($route, $controller, $action, $middleware = [])
    {
        $this->addRoute($route, $controller, $action, Method::DELETE, $middleware);
    }

    public function dispatch()
    {
        try {
            // Get pathname of the request
            $route = strtok($_SERVER['REQUEST_URI'], '?');

            // Get method of the request
            $method = $_SERVER['REQUEST_METHOD'];

            // Check if the method has any routes defined
            if (!empty($this->routes[$method])) {
                foreach ($this->routes[$method] as $routeConfig) {
                    // Match the request URI with the route pattern
                    if (preg_match($routeConfig['pattern'], $route, $matches)) {
                        $controller = $routeConfig['controller'];
                        $action = $routeConfig['action'];
                        $middleware = $routeConfig['middleware'];

                        // Remove numeric keys from matches, only keep named parameters
                        $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);

                        foreach ($middleware as $middlewareClass) {
                            $middlewareInstance = new $middlewareClass();
                            if (!$middlewareInstance instanceof IMiddleware) {
                                throw new \Exception("Middleware must implement IMiddleware interface.");
                            }
                            $middlewareInstance->handle();
                        }

                        $controller = new $controller();

                        // Call the action with the parameters
                        call_user_func_array([$controller, $action], $params);
                        return;
                    }
                }
            }

            // No route found for the method
            header("Location: /not-found");
            exit();
        } catch (MediaNotSupportException $mse) {
            echo $mse->errorMessage();
        } catch (\Throwable $th) {
            echo $th->__toString();
        }
    }
}
