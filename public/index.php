<?php

declare(strict_types=1);
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
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
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

require_once __DIR__ . '/../vendor/autoload.php';

$containerBuilder = new ContainerBuilder();

$dependencies = require_once "../bootstrap.php";
$dependencies($containerBuilder);

$settings = require_once "../settings.php";
$settings($containerBuilder);
$container = $containerBuilder->build();
AppFactory::setContainer($container);
$app = AppFactory::create();

// Create Twig
$twig = Twig::create('./../src/Interface', ['cache' => false]);

// Add Twig-View Middleware
$app->add(TwigMiddleware::create($app, $twig));
// Add Slim routing middleware
$app->addRoutingMiddleware();
$errorMiddleware = $app->addErrorMiddleware(true, true, true);

require_once __DIR__ . '/../src/Middleware/redirectMiddleware.php';
require_once __DIR__ . '/../src/Controllers/userController.php';
require_once __DIR__ . '/../config/route.php';

$app->run();
