<?php
# bootstrap.php

require_once join(DIRECTORY_SEPARATOR, [__DIR__, 'vendor', 'autoload.php']);

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Slim\Factory\AppFactory;
use DI\Container;


$container = new Container();
AppFactory::setContainer($container);
$app = AppFactory::create();
$container = $app->getContainer();

$container->set('myService',function() {
    $entitiesPath = [
                    join(DIRECTORY_SEPARATOR, [__DIR__, "src", "Entity"])
                    ];

    $isDevMode = true;
    $proxyDir = null;
    $cache = null;
    $useSimpleAnnotationReader = false;

    $dbParams = [
        'driver'   => 'pdo_mysql',
        'host'     => 'localhost',
        'charset'  => 'utf8',
        'user'     => 'bastien',
        'password' => 'sqlpass',
        'dbname'   => 'ProjetWebServeur',
    ];
    $config = Setup::createAnnotationMetadataConfiguration(
        $entitiesPath,
        $isDevMode,
        $proxyDir,
        $cache,
        $useSimpleAnnotationReader
    );
    return EntityManager::create($dbParams, $config);
});

return $container;