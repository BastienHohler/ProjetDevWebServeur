<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Doctrine\ORM\EntityManager;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

require_once __DIR__ . '/../src/Controllers/userController.php';



// Define app routes
$app->get('/hello/{name}', function (Request $request, Response $response, $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");
    return $response;
});

$app->get('/', function (Request $request, Response $response) {
    $view = Twig::fromRequest($request);
    return $view->render($response, 'index.php');
    return $response;
});


$app->get('/signUp', function ($request, $response) {
    $view = Twig::fromRequest($request);
    return $view->render($response, 'signUp.php');
});

$app->post('/user', function (Request $request, Response $response, array $args) {
    $uc = new UserController($this->get(EntityManager::class));
    $parsedBody = $request->getParsedBody();
    $response->getBody()->write($uc->createUser($parsedBody['name'],$parsedBody['login'],$parsedBody['password']));
    return $response;
});

$app->get('/deleteUser/{id}', function (Request $request, Response $response, array $args) {
    $uc = new UserController($this->get(EntityManager::class));
    $response->getBody()->write($uc->deleteUser($args['id']));
    return $response;
});
