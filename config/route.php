<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Doctrine\ORM\EntityManager;

require_once __DIR__ . '/../src/Controllers/userController.php';



// Define app routes
$app->get('/hello/{name}', function (Request $request, Response $response, $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");
    return $response;
});

$app->get('/hello', function (Request $request, Response $response) {
    $response->getBody()->write('Hello!');
    return $response;
});

$app->get('/', function(Request $request, Response $response) {
    $response->getBody()->write('Accueil.');
    return $response;
});

$app->post('/createUser/[{name},{login},{password}]', function (Request $request, Response $response, array $args) {
    $uc = new userController($this->get(EntityManager::class),"a");
    $response->getBody()->write($uc->createUser($args['name'],$args['login'],$args['password']));
    return $response;
});

$app->delete('/user/{id}', [UserController::class, 'delete']);
