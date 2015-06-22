<?php

function env($env, $default)
{
    return getenv($env) ? getenv($env) : $default;
}

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$paths = [__DIR__ . "/../src/RadioInfo/Entity"];
$isDevMode = true;

$dbParams = [
    'driver'    => 'pdo_mysql',
    'host'      => env('DB_HOST', '127.0.0.1'),
    'dbname'    => env('DB_NAME', 'radioinfo'),
    'user'      => env('DB_USERNAME', 'root'),
    'password'  => env('DB_PASSWORD', 'root'),
];

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);