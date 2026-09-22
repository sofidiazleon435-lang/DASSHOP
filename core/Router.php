<?php
namespace Core;

class Router {
    protected $controller = 'App\\Controllers\\HomeController';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        $url = $this->parseUrl();

        // Verificar y asignar Controlador
        if (isset($url[0]) && !empty($url[0])) {
            $controllerName = 'App\\Controllers\\' . ucfirst($url[0]) . 'Controller';
            if (class_exists($controllerName)) {
                $this->controller = $controllerName;
                unset($url[0]);
            }
        }

        $this->controller = new $this->controller;

        // Verificar y asignar Método
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // Parámetros restantes
        $this->params = $url ? array_values($url) : [];

        // Ejecutar controlador y método con parámetros
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function parseUrl() {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return [];
    }
}