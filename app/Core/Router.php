<?php
namespace App\Core;

class Router {
    private $routes = [];  
    private $params = [];  

    // Ajouter une route
    public function add($url, $controller, $act, $auth = [], $methode = 'GET') {
        $this->routes[] = [
            'url' => explode('/', trim($url, '/')), // Découper l'URL en segments
            'controller' => $controller,
            'action' => $act,
            'method' => strtoupper($methode), // Forcer la méthode en majuscule
            'auth' => $auth 
        ];
    }

    public function get($url, $controller, $act, $auth = []) {
        $this->add($url, $controller, $act, $auth, 'GET');
    }

    public function post($url, $controller, $act, $auth = []) {
        $this->add($url, $controller, $act, $auth, 'POST');
    }

    public function dispatch($url) {
        $urlSegments = explode('/', trim($url, '/'));
        $method = $_SERVER['REQUEST_METHOD']; 

        foreach ($this->routes as $route) {
            if (count($urlSegments) !== count($route['url']) || $route['method'] !== $method) {
                continue; 
            }

            $this->params = [];
            $match = true;

            foreach ($route['url'] as $index => $segment) {
                if (strpos($segment, '{') === 0 && strpos($segment, '}') === strlen($segment) - 1) {
                    $paramName = trim($segment, '{}');
                    $this->params[$paramName] = $urlSegments[$index];
                } elseif ($segment !== $urlSegments[$index]) {
                    $match = false;
                    break;
                }
            }

            if ($match) {
                if (!$this->checkPermission($route)) {
                    throw new \Exception('Accès non autorisé');
                }

                $controllerName = "App\\Controller\\" . $route['controller'];
                $controller = new $controllerName();
                $action = $route['action'];

                if (method_exists($controller, $action)) {
                    return $controller->$action($this->params);
                }
            }
        }

        throw new \Exception('Route non trouvée');
    }

    private function checkPermission($route) {
        if (empty($route['auth'])) {
            return true;
        }
        return isset($_SESSION['user_role']) && in_array($_SESSION['user_role'], $route['auth']);
    }

    public function getParam($name) {
        return $this->params[$name] ;
    }
}
