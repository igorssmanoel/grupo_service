

<?php
require_once __DIR__ . '/../vendor/autoload.php';
require "../config/bootstrap.php";
session_start();

use App\Router;

$app = new Router();

// Index
$app->get('/', function () {
    return \App\Controller\AppController::index();
});


// Team
$app->get('/team/add', function () {
    return \App\Controller\TeamController::add();
});

$app->post('/team/add', function () {
    return \App\Controller\TeamController::insert();
});

// Tournament
$app->get('/tournament/add', function () {
    return \App\Controller\TournamentController::add();
});

$app->get('/tournament/show', function () {
    return \App\Controller\TournamentController::show();
});

$app->post('/tournament/add', function () {
    return \App\Controller\TournamentController::insert();
});

$app->post('/tournament/score', function () {
    return \App\Controller\TournamentController::update_score();
});


$app->run();
