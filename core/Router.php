<?php

namespace Core;

use Core\Http\Request;
use Core\Http\Response;
use DI\Container;
use App\Views\View;
use Core\Util\Auth;

class Router
{
    private array $routes = [];
    private readonly Container $container;

    public function __construct()
    {
        $this->container = new Container();
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function addRoute(string $method, string $path, string $handler, bool $auth = false, bool $apiAuth = false): void
    {
        $this->routes[$method][$path] = (object)[
            'handler' => $handler,
            'auth' => $auth,
            'apiAuth' => $apiAuth
        ];

    }

    public function handleRequest(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if (isset($this->routes[$method])) {
            foreach ($this->routes[$method] as $routePath => $handler) {
                $pattern = $this->getRouteRegex($routePath);

                if (preg_match($pattern, $path, $matches)) {
                    // Remove the full match from the beginning of the array
                    array_shift($matches);

                    // Create an associative array of parameter names and values
                    $params = (object)array_combine($this->getParameterNames($routePath), $matches);

                    // Call the handler with the matched parameters
                    $this->callHandler($handler->handler, $params, $handler->auth, $handler->apiAuth);
                    return;
                }
            }
        }

        // Handle 404 Not Found
        $this->notFound();
    }

    private function getRouteRegex($routePath): string
    {
        // Convert route path to a regex pattern
        $pattern = preg_replace_callback('/{([^\/]+)}/', function ($matches) {
            return '([^\/]+)';
        }, $routePath);

        // Add delimiters and make it case-insensitive
        return '@^' . $pattern . '$@i';
    }

    private function getParameterNames($routePath): array
    {
        preg_match_all('/{([^\/]+)}/', $routePath, $matches);
        return $matches[1];
    }

    private function callHandler($handler, $params, bool $auth = false, bool $apiAuth = false): void
    {
        if ($auth) {
            Auth::requireLogin();
        }
        if ($apiAuth) {
            if (!Auth::authenticateBasic()) {
                Response::withEmptyBody()->setStatusCode(401)->setBody("Unauthorized")->send();
                return;
            }
        }
        if (is_callable($handler)) {
            // If the handler is a callable function, call it
            call_user_func($handler);
        } elseif (is_string($handler) && str_contains($handler, '@')) {
            // If the handler is in the "Controller@action" format
            list($controller, $action) = explode('@', $handler);

            $controllerClassName = "App\\Controllers\\" . $controller;
            try {
                $controllerInstance = $this->container->get($controllerClassName);
            } catch (\Exception $e) {
                http_response_code(500);
                echo "Internal Server Error " . $e->getMessage();
                return;
            }

            $request = new Request($params);
            if (method_exists($controllerInstance, $action)) {
                // Call the controller action method
                $controllerInstance->$action($request);
            } else {
                // Handle 404 Not Found for missing action
                $this->notFound();
            }
        } else {
            // Handle invalid handler format
            $this->notFound();
        }
    }

    private function notFound(): void
    {
        View::createWithViewFile('home/404.php')->render([]);
    }
}
