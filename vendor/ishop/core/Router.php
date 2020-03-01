<?php


namespace ishop;


class Router
{
    protected static $routes = [];
    protected static $route = [];


    public static function add(string $regexp, array $route = [])
    {
        self::$routes[$regexp] = $route;
    }

    public static function getRoutes()
    {
        return self::$routes;
    }

    public static function getRoute()
    {
        return self::$route;
    }

    public static function dispatch($url)
    {
        if (!self::matchRoute($url)) {
            throw new \Exception('Страница не найдена', 404);
        }
        $controller = 'app\controllers\\' . self::$route['prefix'] . self::$route['controller'] . 'Controller';

        if (!class_exists($controller)) {
            throw new \Exception('Контроллер не найден: ' . $controller, 404);
        }
        $controllerObject = new $controller(self::$route);
        $action = self::lowerCamelCase(self::$route['action']) . 'Action';
        if(!method_exists($controllerObject, $action)) {
            throw new \Exception("Метод $action в контроллере $controller не найден");
        }
        $controllerObject->$action();
        $controllerObject->getView();

    }

    public static function matchRoute($url)
    {
        foreach (self::$routes as $pattern => $route) {
           if (preg_match("#$pattern#", $url, $matches)) {
               foreach ($matches as $key => $value) {
                   if (is_string($key)) {
                       $route[$key] = $value;
                   }
               }
               if (empty($route['action'])) {
                   $route['action'] = 'index';
               }

               if (!isset($route['prefix'])) {
                   $route['prefix'] = '';
               } else {
                   $route['prefix'] .= '\\';
               }
               $route['controller'] = self::upperCamelCase($route['controller']);
               self::$route = $route;
               return true;
           }
        }
        return false;
    }

    protected static function upperCamelCase(string $name)
    {
        return str_replace('-', '', ucwords($name, '-'));
    }

    protected static function lowerCamelCase(string $name)
    {
        return lcfirst(self::upperCamelCase($name));
    }
}