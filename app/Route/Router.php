<?php

namespace App\Route;

use App\Core\View;

class Router
{
    protected $routes = [];
    protected $middlewares = [];
    protected $registeredMiddlewares = [];

    public function get($path, $controllerMethod)
    {
        $path = trim($path, '/');
        $this->routes['GET'][] = [
            'path' => $path,
            'controllerMethod' => $controllerMethod,
            'middlewares' => []
        ];
        return $this;
    }

    public function middleware(...$middlewares)
    {
        $lastIndex = array_key_last($this->routes['GET']);
        foreach ($middlewares as $mw) {
            $this->routes['GET'][$lastIndex]['middlewares'][] = $mw;
        }
        return $this;
    }

    public function registerMiddleware(string $name, callable $callback)
    {
        $this->registeredMiddlewares[$name] = $callback;
    }

    public function dispatch()
    {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $basePath = '/demo/public/'; // Adapter si besoin
        $requestUri = $_SERVER['REQUEST_URI'] ?? '/';
        $path = parse_url($requestUri, PHP_URL_PATH);

        // Retirer le chemin de base (si présent)
        if (strpos($path, $basePath) === 0) {
            $path = substr($path, strlen($basePath));
        }

        $url = trim($path, '/');

        // ⛔ Éviter d’intercepter les fichiers statiques (CSS, JS, images...)
        $extension = pathinfo($url, PATHINFO_EXTENSION);
        $staticExtensions = ['css', 'js', 'png', 'jpg', 'jpeg', 'gif', 'svg', 'ico', 'webp'];

        if (in_array($extension, $staticExtensions)) {
            return false; // Laisser Apache/Nginx ou le serveur PHP servir le fichier
        }

        if (!isset($this->routes[$method])) {
            return $this->render404();
        }

        foreach ($this->routes[$method] as $route) {
            // Gestion des routes dynamiques
            $pattern = preg_replace('#\{[a-zA-Z0-9_]+\}#', '([a-zA-Z0-9_-]+)', $route['path']);
            $pattern = '#^' . $pattern . '$#';

            if (preg_match($pattern, $url, $matches)) {
                array_shift($matches); // Supprimer l’URL complète de $matches

                // 🔐 Exécution des middlewares
                foreach ($route['middlewares'] as $mwName) {
                    if (!isset($this->registeredMiddlewares[$mwName])) {
                        throw new \Exception("Middleware '$mwName' non enregistré.");
                    }

                    $result = call_user_func($this->registeredMiddlewares[$mwName]);

                    if ($result === false) {
                        return; // Middleware a bloqué l’accès
                    }
                }

                return $this->callController($route['controllerMethod'], $matches);
            }
        }

        return $this->render404();
    }

    protected function callController(string $controllerMethod, array $params = [])
    {
        [$controllerName, $methodName] = explode('@', $controllerMethod);
        $controllerClass = 'App\\Controllers\\' . $controllerName;

        if (class_exists($controllerClass)) {
            $controller = new $controllerClass();

            if (method_exists($controller, $methodName)) {
                return call_user_func_array([$controller, $methodName], $params);
            }
        }

        return $this->render404();
    }

    protected function render404()
    {
        http_response_code(404);
        return View::render('error', [], 'layout');
    }
}
