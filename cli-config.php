<?php
# cli-config.php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Slim\Container;


$container = require_once join(DIRECTORY_SEPARATOR, [__DIR__, 'bootstrap.php']);

return ConsoleRunner::createHelperSet($container[EntityManager::class]);