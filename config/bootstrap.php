<?php

require "../vendor/autoload.php";


use Illuminate\Database\Capsule\Manager as Capsule;


$capsule = new Capsule;

$capsule->addConnection([

    "driver" => "mysql",

    "host" => "localhost",

    "database" => "sinuca",

    "username" => "admin",

    "password" => "admin",

]);

$capsule->setAsGlobal();

$capsule->bootEloquent();


if (!defined('ABSPATH')) {
    define('ABSPATH', dirname(__FILE__) . '/');
}

define('HEADER_TEMPLATE', ABSPATH . '../views/template/header.php');
define('FOOTER_TEMPLATE', ABSPATH . '../views/template/footer.php');
