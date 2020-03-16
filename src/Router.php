<?php

namespace App;

class Router
{
    private $routes;
    private static $params = [];
    protected $methods = ['get', 'post'];

    public function __construct()
    {
    }

    private function validate(string $method)
    {
        return in_array($method, $this->methods);
    }

    public function __call(string $method, array $args)
    {
        $method = strtolower($method);

        if (!$this->validate($method)) {
            return false;
        }

        [$route, $action] = $args;
        if (!isset($action) or !is_callable($action)) {
            return false;
        }

        $this->routes[$method][$route] = $action;
        return true;
    }

    public function run()
    {
        $method = strtolower($_SERVER['REQUEST_METHOD']) ?? 'get';
        $route = $_GET['r'] ?? '/';

        if (!isset($this->routes[$method])) {
            die('405 Method not allowed');
        }

        if (!isset($this->routes[$method][$route])) {
            die('404 Error');
        }

        self::$params = $this->getParams($method);

        die($this->routes[$method][$route]());
    }

    public function patternExists($patterns, $url)
    {
        foreach ($patterns as $key => $value) {
            $match = $this->checkUrlAgainstPattern($url, $value);
            if ($match) {
                return $match;
            }
        }

        return false;
    }

    public function checkUrlAgainstPattern($url, $pattern)
    {
        // parse $pattern into a regex, and build a list of variable names
        $vars = array();
        $regex = preg_replace_callback(
            '#/:([a-z]+)(?=/|$)#',
            function ($x) use (&$vars) {
                $vars[] = $x[1];
                return '/([^/]+)';
            },
            $pattern
        );

        // check $url against the regex, and populate variables if it matches
        $vals = array();
        if (preg_match("#^{$regex}$#", $url, $x)) {
            foreach ($vars as $id => $var) {
                $vals[$var] = $x[$id + 1];
            }
            return $vals;
        } else {
            return false;
        }
    }

    private function getParams(string $method)
    {
        if ($method == 'get') {
            return $_GET;
        }

        return $_POST;
    }

    public static function getRequest()
    {
        return self::$params;
    }
}
