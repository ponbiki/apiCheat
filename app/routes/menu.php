<?php

use ponbiki\apiCheat as cheat;

$app->get('/menu', function() use ($app) {
    
    if (!isset($_SESSION['api_key'])) {
        $app->redirect('/');
    }
    
    $page = "Menu";
    $meta = "API Cheat Menu";
    
    $app->render('menu.html.twig', [
        'page' => $page,
        'meta' => $meta,
        'info' => $_SESSION['info'],
        'error' => $_SESSION['error'],
        'loggedin' => $_SESSION['loggedin']
    ]);
    
    
})->name('menu');