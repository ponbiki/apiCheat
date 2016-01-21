<?php

use ns1\apiCheat as cheat;


$app->get('/menu', function() use ($app) {
    
    if (!isset($_SESSION['api']->valid_key)) {
        $app->redirect('/');
    }
    $page = "Menu";
    $meta = "API Cheat Menu";
    
    $app->render('menu.html.twig', [
        'page' => $page,
        'meta' => $meta,
        'info' => $_SESSION['info'],
        'error' => $_SESSION['error'],
        'loggedin' => $_SESSION['loggedin'],
        'zones' => $_SESSION['api']->zonelist
    ]);
    
    cheat\Session::clear();    
    
})->name('menu');