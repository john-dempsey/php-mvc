<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\Application;
use app\controllers\SiteController;
use app\controllers\AuthController;
use app\controllers\CreditCardController;

$dir = dirname(__DIR__);

$dotenv = \Dotenv\Dotenv::createImmutable($dir);
$dotenv->load();

$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'username' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];

$app = new Application($dir, $config);

$app->router->get('/', [SiteController::class, 'home']);

$app->router->get('/cards', [CreditCardController::class, 'index']);
$app->router->get('/cards/create', [CreditCardController::class, 'create']);
$app->router->post('/cards/store', [CreditCardController::class, 'store']);
$app->router->post('/cards/delete', [CreditCardController::class, 'delete']);

$app->run();
?>