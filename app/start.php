<?php

require '../vendor/autoload.php';

$app = new \Slim\Slim([
    'view' => new \Slim\Views\Twig()
]);

// Views
$view = $app->view();
$view->setTemplateDirectory('../app/views');
$view->parserExtensioons = [
    new \Slim\Views\TwigExtension()
];

require 'routes.php';

$app->run();