<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use Tiptone\Aydd\Controller\IndexController;
//use Tiptone\Aydd\Database\Db;

return [
    'app_name' => 'AYDD',
    'routes' => [
        'home' => [
            'path' => '/',
            'default' => 'index',
            'controller' => IndexController::class,
        ],
    ],
    'container' => [
        LoggerInterface::class => DI\factory(function() {
            $logger = new Logger('aydd');
            $logger->pushHandler(new StreamHandler('php://stdout', Logger::INFO, false));
            $logger->pushHandler(new StreamHandler('php://stderr', Logger::ERROR, false));

            return $logger;
        }),
        Environment::class => DI\factory(function() {
            $loader = new FilesystemLoader(__DIR__ . '/../templates');
            $twig = new Environment($loader);

            return $twig;
        }),
//        Db::class => DI\factory(function() {
//            $db = new Db(__DIR__ . '/../data/reviews.db');
//            $db->enableExceptions(true);
//
//            return $db;
//        }),
        IndexController::class => function(ContainerInterface $container) {
            $controller = new IndexController();
            $controller->setLogger($container->get(LoggerInterface::class));

            return $controller;
        },
    ],
];
