<?php


namespace core;



class Router {
    /**
     * @var array вес список маршутов
     * @static
    */
    private static $routes = [];

    /**
     * @var array  текоший маршут
     * @static
     */
    private static $route = [];


    /**
     * @var array вес список переданно параметров
     * @static
     */

    private static $params = [];

    /**
     * получает все необходимое настройки для маршутизации
     * @param string $regexp  регуларное виражения для маршутизации
     * @param array $route  внутри распаложенно имя класса и имя метода если сушествует
     * @return void
     * @static
     */

    public static function route($regexp, $route = [])    {
        self::$routes[$regexp] = $route;

        return new static;
    }
    /**
     * возврашает список моршутв
     * @return array текушй моршут
     * @static
     */
    public static function getRoutes() {
        return self::$routes;
    }
    /**
     * возврашает текушй моршут
     * @return array текушй моршут
     * @static
     */
    public static function getRoute() {
        return self::$route;
    }

    /**
     * ищит совпаденя в маршутах
     * @param string $url полученно ссылка из адресний строки браузера
     * @return bool
     *@static
     */
    private static function matchRoute($url) {
        $query_arr = explode('/', $url);
        if (count($query_arr) < 3){
            foreach (self::$routes as $pattern => $route) {
                if (preg_match("!$pattern!i", $url, $matches)){
                    foreach ($matches as $key => $val){
                        if (is_string($key)){
                            $route[$key] = $val;
                        }
                    }
                    if (!isset($route['action'])){
                        $route['action'] = 'index';
                    }
                    self::$route = $route;
                    return true;
                }
            }
        }else{
            self::$route['controller'] = array_shift($query_arr);
            self::$route['action'] = array_shift($query_arr);
            self::$params = $query_arr;
            return true;
        }

        return false;
    }

    /**
     * подклучает необхадимое класс и взывает метод если нет ощибка,
     * а если есть ошибка перенаправляеть страница 404
     * @param string $url
     * @return  void
     * @static
     */
    private static function dispatch($url) {
        if (self::matchRoute($url)){
            $controller = 'app\controllers\\' . self::upperCamelCase(self::$route['controller']).'Controller';
            if (class_exists($controller)){
                $classObj = new $controller;

                $action = lcfirst(self::upperCamelCase(self::$route['action'])) . 'Action';

                if (method_exists($classObj, $action)){
                    call_user_func_array([$classObj,$action], self::$params);
                }else{
                    dump($action);
                    DEBUG ? die('Method Note Exist') : view('404.html');

                }

            }else{
                DEBUG ? die('Class Note Exist') : view('404.html');
            }

        }else{
            http_response_code(404);
            view('404');

        }
    }

    /**
     * получает страка и возврашаеть первй буква главним
     * @param string $string
     * @return string
     * @static
     */

    private static function upperCamelCase ($string){
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    }

    /**
     * запускает роутер
     * @param string $uri  полученний URL.
     * @return void
     * @static
     */

    public static function run($uri){
        $uri = trim($uri, '/');

        self::dispatch($uri);

    }


}