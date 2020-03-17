<?php

require "../vendor/autoload.php";


use Dotenv\Dotenv;
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

/* $capsule->addConnection([

    "driver" => "mysql",

    "host" => "localhost",

    "database" => "sinuca",

    "username" => "admin",

    "password" => "admin",


]); */
$capsule->addConnection([

    "driver" => getenv('PHP_DRIVER'),

    "host" => getenv('PHP_HOST'),

    "database" => getenv('PHP_DATABASE'),

    "username" => getenv('PHP_USERNAME'),

    "password" => getenv('PHP_PASSWORD')


]);

/* $capsule->addConnection(['connection' => 'mysql://b668bc46279ff3:1f568d27@us-cdbr-iron-east-04.cleardb.net/heroku_23b86bdd8c394e4?reconnect=true']); */


/* $capsule->addConnection(["url" => getenv('PHP_CONNECTION_STRING')]); */

$capsule->setAsGlobal();

$capsule->bootEloquent();

$max_teams = getenv('PHP_NUMERO_MAXIMO_TIMES') ?? 10;
define('MAX_TEAMS', $max_teams);

if (!defined('ABSPATH')) {
    define('ABSPATH', dirname(__FILE__) . '/');
}

define('HEADER_TEMPLATE', ABSPATH . '../views/template/header.php');
define('FOOTER_TEMPLATE', ABSPATH . '../views/template/footer.php');
