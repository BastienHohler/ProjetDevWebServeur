<?php

declare(strict_types=1);
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Selective\BasePath\BasePathMiddleware;
use Slim\Factory\AppFactory;
use Slim\App;
use UMA\DIC\Container;
use DI\ContainerBuilder;
use UMA\DoctrineDemo\DI;
use Invoker\Invoker;
use Invoker\ParameterResolver\AssociativeArrayResolver;
use Invoker\ParameterResolver\Container\TypeHintContainerResolver;
use Invoker\ParameterResolver\DefaultValueResolver;
use Invoker\ParameterResolver\ResolverChain;

require __DIR__ . '/../vendor/autoload.php';

$containerBuilder = new ContainerBuilder();

$dependencies = require_once "../bootstrap.php";
$dependencies($containerBuilder);

$settings = require_once "../settings.php";
$settings($containerBuilder);
$container = $containerBuilder->build();
AppFactory::setContainer($container);
$app = AppFactory::create();
// Add Slim routing middleware
$app->addRoutingMiddleware();
$errorMiddleware = $app->addErrorMiddleware(true, true, true);

require __DIR__ . '/../src/Controllers/UserController.php';
require __DIR__ . '/../config/route.php';

$app->run();
