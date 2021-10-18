<?php

declare(strict_types=1);

//namespace UMA\DoctrineDemo\Action;

use Doctrine\ORM\EntityManager;
use Faker;
use Nyholm\Psr7;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use function json_encode;

require_once __DIR__ . '/../Model/User.php';


class userController implements RequestHandlerInterface
{
    /**
     * @var EntityManager
     */
    private $em;

    /*/**
     * @var Faker\Generator
     */
    private $faker;

    public function createUser($name,$login,$password) {
        $user = new User();
        $user->setNom($name);
        $user->setLogin($login);
        $user->setPassword($password);
        $this->em->persist($user);
        $this->em->flush();
        return "Bienvenue, ".$name.". Votre ID est : ".$user->getId().".";
    }

    public function __construct(EntityManager $em, /*Faker\Generator*/ $faker)
    {
        $this->em = $em;
        $this->faker = $faker;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $newRandomUser = new User($this->faker->name, $this->faker->password,$this->faker->login,$this->faker->mail);

        $this->em->persist($newRandomUser);
        $this->em->flush();

        $body = Psr7\Stream::create(json_encode($newRandomUser, JSON_PRETTY_PRINT) . PHP_EOL);

        return new Psr7\Response(
            201,
            [
                'Content-Type' => 'application/json',
                'Content-Length' => $body->getSize()
            ],
            $body
        );
    }
}
