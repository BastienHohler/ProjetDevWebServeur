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
    session_start();
    if(isset($_SESSION["userName"])){
        return $view->render($response, 'index.php',['name' => $_SESSION["userName"]]);
    }else return $view->render($response, 'index.php');
});

// route User

$app->get('/signUp', function ($request, $response) {
    $view = Twig::fromRequest($request);
    return $view->render($response, 'signUp.php');
});

$app->post('/user', function (Request $request, Response $response, array $args) {
    $uc = new UserController($this->get(EntityManager::class));
    $parsedBody = $request->getParsedBody();
    $uc->createUser($parsedBody);
    header('Location: localhost:8080/');
});

$app->get('/deleteUser/{id}', function (Request $request, Response $response, array $args) {
    $uc = new UserController($this->get(EntityManager::class));
    $response->getBody()->write($uc->deleteUser($args['id']));
    return $response;
});
