<?php

use Doctrine\ORM\EntityManager;

$container = require_once join(DIRECTORY_SEPARATOR, [__DIR__, 'bootstrap.php']);
$entityManager = $container->get("myService");

require __DIR__."/src/Entity/User.php";

// Instanciation de l'utilisateur

$admin = new User();
$admin->setName("Bastien");
$admin->setLogin("bastien");
$admin->setPass("pass");

// Gestion de la persistance
$entityManager->persist($admin);
$entityManager->flush();

// Vérification du résultats
echo "Identifiant de l'utilisateur créé : ", $admin->getId();
?>