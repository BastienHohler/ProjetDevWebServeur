<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Doctrine\ORM\EntityManager;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

require_once __DIR__ . '/../src/Controllers/userController.php';
require_once __DIR__ . '/../src/Controllers/groupController.php';
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
    if (isset($_SESSION["userName"])) {
        return $view->render($response, 'index.php', ['name' => $_SESSION["userName"], "id" => $_SESSION["userId"]]);
    } else return $view->render($response, 'signIn.php');
});

// route User

$app->get('/signUp', function ($request, $response) {
    $view = Twig::fromRequest($request);
    session_start();
    if (isset($_SESSION["userName"])) {
        return $view->render($response, 'index.php', ['name' => $_SESSION["userName"]]);
    } else {
        return $view->render($response, 'signUp.php', ['messageError' => $_SESSION["messageError"]]);
    }
});

$app->get('/signIn', function ($request, $response) {
    $view = Twig::fromRequest($request);
    session_start();
    if (isset($_SESSION["userName"])) {
        return $view->render($response, 'index.php', ['name' => $_SESSION["userName"]]);
    } else if (isset($_SESSION["messageErrorSignin"])) {
        return $view->render($response, 'signIn.php', ['messageError' => $_SESSION["messageErrorSignin"]]);
    } else {
        return $view->render($response, 'signIn.php');
    }
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

    if (isset($_SESSION["userName"])) {
        $mc = new MessageController($this->get(EntityManager::class));
        $messages = $mc->getAll();
        return $view->render($response, 'messagerie.php', ['messages' => $messages, 'name' => $_SESSION['userName']]);
    } else return $view->render($response, 'signIn.php', ['messageError' => 'Vous devez être connecté']);
});

$app->get('/messagerie/group/{id}', function (Request $request, Response $response, array $args) {
    $view = Twig::fromRequest($request);
    session_start();
    $gc = new GroupController($this->get(EntityManager::class));
    $group = $gc->findById($args['id']);
    if (isset($_SESSION["userName"])) {
        $mc = new MessageController($this->get(EntityManager::class));
        $messages = $mc->getAllGroup($args['id']);
        return $view->render($response, 'messagerie.php', ['group' => $group, 'messages' => $messages, 'name' => $_SESSION['userName']]);
    } else return $view->render($response, 'signIn.php', ['messageError' => 'Vous devez être connecté']);
});

$app->get('/messagerie/group/{id}/new', function (Request $request, Response $response, array $args) {
    $view = Twig::fromRequest($request);
    session_start();
    if (isset($_SESSION["userName"])) {
        $gc = new GroupController($this->get(EntityManager::class));
        $group = $gc->findById($args['id']);
        return $view->render($response, 'newMessage.php', ['group' => $group, 'messageSuccess' => $_SESSION['messageSuccess'], 'messageError' => $_SESSION["messageError"], 'name' => $_SESSION['userName']]);
    } else return $view->render($response, 'signIn.php', ['messageError' => 'Vous devez être connecté']);
});

$app->get('/messagerie/new', function (Request $request, Response $response) {
    $view = Twig::fromRequest($request);
    session_start();
    if (isset($_SESSION["userName"])) {
        $fc = new FriendController($this->get(EntityManager::class));
        $listFriends = $fc->listFriends($_SESSION["userId"]);
        $uc = new UserController($this->get(EntityManager::class));
        $groupsUser = $uc->getGroups($_SESSION['userId']);


        return $view->render($response, 'newMessage.php', ['groups' => $groupsUser, 'friendsList' => $listFriends, 'messageSuccess' => $_SESSION['messageSuccess'], 'messageError' => $_SESSION["messageError"], 'name' => $_SESSION['userName']]);
    } else return $view->render($response, 'signIn.php', ['messageError' => 'Vous devez être connecté']);
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
    session_start();
    if (isset($_SESSION["userId"])) {
        if ($_SESSION["userId"] == $args['id']) {
            $uc = new UserController($this->get(EntityManager::class));
            $uc->deleteUser($args['id']);
            return $response;
        } else {
            $_SESSION["header"] = "Location:http://localhost:8080/friend";
            return $response;
        }
    } else {
        $_SESSION["header"] = "Location:http://localhost:8080/friend";
        return $response;
    }
})->add(redirectMiddleware::class);

$app->get('/signOut', function (Request $request, Response $response, array $args) {
    $uc = new UserController($this->get(EntityManager::class));
    $uc->signOut();
    return $response;
})->add(redirectMiddleware::class);

$app->get('/friend', function (Request $request, Response $response) {
    $view = Twig::fromRequest($request);
    session_start();
    if (isset($_SESSION["userName"])) {
        $uc = new FriendController($this->get(EntityManager::class));
        $listFriends = $uc->listFriends($_SESSION["userId"]);
        $listPending = $uc->pendingList($_SESSION["userId"]);
        $listRequest = $uc->requestList($_SESSION["userId"]);
        $nonFriendsList = $uc->nonFriendsList($_SESSION["userId"]);
        return $view->render($response, 'friends.php', ['listFriends' => $listFriends, 'listPending' => $listPending, 'listRequest' => $listRequest, 'nonFriendsList' => $nonFriendsList, 'name' => $_SESSION["userName"], "id" => $_SESSION["userId"]]);
    } else return $view->render($response, 'signIn.php', ['messageError' => 'Vous devez être connecté']);
});

$app->post('/friend', function (Request $request, Response $response) {
    $uc = new FriendController($this->get(EntityManager::class));
    $parsedBody = $request->getParsedBody();
    $uc->createFriend($parsedBody);
    return $response;
})->add(redirectMiddleware::class);

$app->get('/groups', function (Request $request, Response $response) {
    $view = Twig::fromRequest($request);
    session_start();

    if (isset($_SESSION["userName"])) {
        $uc = new UserController($this->get(EntityManager::class));
        $groupsUser = $uc->getGroups($_SESSION['userId']);
        $gc = new GroupController($this->get(EntityManager::class));
        $availableGrps = $gc->getAvailableGroups($_SESSION['userId']);
        return $view->render($response, 'groups.php', ['grpsUser' => $groupsUser, 'availableGrps' => $availableGrps, 'name' => $_SESSION['userName'], 'user_id' => $_SESSION['userId']]);
    } else return $view->render($response, 'signIn.php', ['messageError' => 'Vous devez être connecté']);
});

$app->get('/groups/delete/{id}', function (Request $request, Response $response, array $args) {
    session_start();
    if (isset($_SESSION["userId"])) {
        $gc = new GroupController($this->get(EntityManager::class));
        $gc->deleteGroup($args['id']);
        return $response;
    } else {
        $_SESSION["header"] = "Location:http://localhost:8080/friend";
        return $response;
    }
})->add(redirectMiddleware::class);

$app->get('/groups/leave/{id}', function (Request $request, Response $response, array $args) {
    session_start();
    if (isset($_SESSION["userId"])) {
        $gc = new GroupController($this->get(EntityManager::class));
        $gc->removeUserGroup($args['id'], $_SESSION['userId']);
        $_SESSION["header"] = "Location:http://localhost:8080/groups";
        return $response;
    } else {
        $_SESSION["header"] = "Location:http://localhost:8080/signIn";
        return $response;
    }
})->add(redirectMiddleware::class);

$app->get('/deleteFriend/{id}', function (Request $request, Response $response, array $args) {
    session_start();
    if (isset($_SESSION["userId"])) {
        $uc = new FriendController($this->get(EntityManager::class));
        $uc->deleteFriend($args['id']);
        return $response;
    } else {
        $_SESSION["header"] = "Location:http://localhost:8080/friend";
        return $response;
    }
})->add(redirectMiddleware::class);

$app->get('/groups/join/{id}', function (Request $request, Response $response, array $args) {
    session_start();
    if (isset($_SESSION["userId"])) {
        $gc = new GroupController($this->get(EntityManager::class));
        $gc->addUserGroup($args['id'], $_SESSION['userId']);
        $_SESSION["header"] = "Location:http://localhost:8080/groups";
        return $response;
    } else {
        $_SESSION["header"] = "Location:http://localhost:8080/signIn";
        return $response;
    }
})->add(redirectMiddleware::class);

$app->post('/groups', function (Request $request, Response $response, array $args) use ($app) {
    session_start();
    if (isset($_SESSION['userId'])) {
        $gc = new GroupController($this->get(EntityManager::class));
        $parsedBody = $request->getParsedBody();
        $gc->createGroup($parsedBody, $_SESSION['userId']);
        $_SESSION["header"] = "Location:http://localhost:8080/groups";
        return $response;
    } else {
        $_SESSION["header"] = "Location:http://localhost:8080/signIn";
        return $response;
    }
})->add(redirectMiddleware::class);

$app->get('/deleteMessage/{id}', function (Request $request, Response $response, array $args) {
    $mc = new MessageController($this->get(EntityManager::class));
    $mc->deleteMessage($args['id']);
    return $response;
})->add(redirectMiddleware::class);
