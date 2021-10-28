<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Doctrine\ORM\EntityManager;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

require_once __DIR__ . '/../src/Controllers/userController.php';
require_once __DIR__ . '/../src/Controllers/messageController.php';



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
    }else return $view->render($response, 'signIn.php');
});

// route User

$app->get('/signUp', function ($request, $response) {
    $view = Twig::fromRequest($request);
    session_start();
    if(isset($_SESSION["userName"])){
        return $view->render($response, 'index.php',['name' => $_SESSION["userName"]]);
    }return $view->render($response, 'signUp.php',['messageError' => $_SESSION["messageError"]]);
});

$app->get('/signIn', function ($request, $response) {
    $view = Twig::fromRequest($request);
    session_start();
    if(isset($_SESSION["userName"])){
        return $view->render($response, 'index.php',['name' => $_SESSION["userName"]]);
    }else return $view->render($response, 'signIn.php',['messageError' => $_SESSION["messageError"]]);
});

$app->post('/user', function (Request $request, Response $response, array $args) use ($app) {
    $uc = new UserController($this->get(EntityManager::class));
    $parsedBody = $request->getParsedBody();
    $uc->createUser($parsedBody);
    return $response;
})->add(redirectMiddleware::class);

$app->get('/messagerie', function (Request $request, Response $response) {
    $view = Twig::fromRequest($request);
    session_start();
    
    if(isset($_SESSION["userName"])){
        $mc = new MessageController($this->get(EntityManager::class));
        $messages = $mc->getAll();
        return $view->render($response, 'messagerie.php', ['messages' => $messages]);
    }else return $view->render($response, 'signIn.php', ['messageError' => 'Vous devez être connecté']);
});

$app->get('/messagerie/new', function (Request $request, Response $response) {
    $view = Twig::fromRequest($request);
    session_start();
    if(isset($_SESSION["userName"])){
        $mc = new MessageController($this->get(EntityManager::class));
        $messages = $mc->getAll();
        return $view->render($response, 'newMessage.php',['messageSuccess' => $_SESSION['messageSuccess'],'messageError' => $_SESSION["messageError"]]);
    }else return $view->render($response, 'signIn.php', ['messageError' => 'Vous devez être connecté']);
});


$app->post('/authentication', function (Request $request, Response $response, array $args) use ($app) {
    $uc = new UserController($this->get(EntityManager::class));
    $parsedBody = $request->getParsedBody();
    $uc->login($parsedBody);
    return $response;
})->add(redirectMiddleware::class);

$app->post('/send', function (Request $request, Response $response, array $args) use ($app) {
    $mc = new MessageController($this->get(EntityManager::class));
    $parsedBody = $request->getParsedBody();
    $mc->createMessage($parsedBody);
    return $response;
})->add(redirectMiddleware::class);

$app->get('/deleteUser/{id}', function (Request $request, Response $response, array $args) {
    $uc = new UserController($this->get(EntityManager::class));
    $response->getBody()->write($uc->deleteUser($args['id']));
    return $response;
});
