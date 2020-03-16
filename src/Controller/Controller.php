<?php
namespace App\Controller;

use App\Router;

abstract class Controller
{
    final protected function view(string $_name, array $vars = [])
    {
        $_filename = __DIR__ . "/../../views/{$_name}.php";
        if (!file_exists($_filename)) {
            die("View {$_name} not found!");
        }

        include_once $_filename;
    }

    final protected function params(string $name = '')
    {
        $params = Router::getRequest();

        if (!isset($params[$name])) {
            return $params;
        }

        return $params[$name];
    }

    final protected function redirect(string $to)
    {
        $url = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
        $folders = explode('?', $_SERVER['REQUEST_URI'])[0];

        header('Location:' . $url . $folders . '?r=' . $to);
        exit();
    }
}
