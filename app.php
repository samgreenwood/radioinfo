<?php

require 'vendor/autoload.php';

use Slim\Slim;

if(file_exists(__DIR__ . '/.env'))
{
    $dotenv = new Dotenv\Dotenv(__DIR__);
    $dotenv->load();
}

require 'bootstrap/database.php';

$app = new Slim([
    'templates.path' => '../templates',
    'view' => new \Slim\Views\Twig(),
]);

require 'routes.php';

$app->run();