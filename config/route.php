<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
require __DIR__ . '/../src/Controllers/UserController.php';

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

$app->get('/createUser/[{name},{login},{password}]', function (Request $request, Response $response, array $args) {
    $response = createUser($args);
    return $response;
});

$app->delete('/user/{id}', [UserController::class, 'delete']);
