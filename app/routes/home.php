<?php

use ponbiki\apiCheat as cheat;

new cheat\Session();

$app->get('/', function() use ($app) {
    
    $page = "Api Key Entry";
    $meta = "";
    
    if ($_SESSION['api_key']) {
        $app->redirect('/menu');
    }
    
    $app->render('home.html/twig', [
        'page' => $page,
        'meta' => $meta,
        'error' => $_SESSION['error']
    ]);
    
    cheat\Session::clear();
    
})->name('home');

$app->post('/', function () use ($app) {
    $_SESSION['api_key'] = \filter_var(($app->request()->post('api_key')), FILTER_SANITIZE_STRING);
    
    if ($_SESSION['api_key'] == "" /* || key validation check failure */) {
        $_SESSION['error'] = "Please enter your API key";
        $app->redirect('/');
    } else {
        cheat\Session::clear();
        $app->redirect('/menu');
    }
});