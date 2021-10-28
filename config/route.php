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
        return $view->render($response, 'index.php',['name' => $_SESSION["userName"], "id" => $_SESSION["userId"]]);
    }else return $view->render($response, 'index.php');
});

// route User

$app->get('/signUp', function ($request, $response) {
    $view = Twig::fromRequest($request);
    session_start();
    if(isset($_SESSION["messageError"])){
        return $view->render($response, 'signUp.php',['messageError' => $_SESSION["messageError"]]);
    }else return $view->render($response, 'signUp.php');
});

$app->post('/user', function (Request $request, Response $response, array $args) use ($app) {
    $uc = new UserController($this->get(EntityManager::class));
    $parsedBody = $request->getParsedBody();
    $uc->createUser($parsedBody);
    return $response;
})->add(redirectMiddleware::class);

$app->get('/deleteUser/{id}', function (Request $request, Response $response, array $args) {
    $uc = new UserController($this->get(EntityManager::class));
    $uc->deleteUser($args['id']);
    return $response;
});

$app->get('/signOut', function (Request $request, Response $response, array $args) {
    $uc = new UserController($this->get(EntityManager::class));
    $uc->signOut();
    return $response;
});

$app->get('/friend', function (Request $request, Response $response) {
    $view = Twig::fromRequest($request);
    session_start();
    if(isset($_SESSION["userName"])){
        $uc = new FriendController($this->get(EntityManager::class));
        $listFriends = $uc->listFriends($_SESSION["userId"]);
        $listPending = $uc->pendingList($_SESSION["userId"]);
        return $view->render($response, 'friends.php',['listFriends' => $listFriends, 'listPending' => $listPending, 'name' => $_SESSION["userName"], "id" => $_SESSION["userId"]]);
    }
});