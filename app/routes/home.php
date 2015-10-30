<?php

use ponbiki\apiCheat as cheat;

new cheat\Session();

$app->get('/', function () use ($app) {
    
    $page = "Api Key Entry";
    $meta = "Login";
    
    if (!array_key_exists('error', $_SESSION)) {
        $_SESSION['error'] = [];
    }    

    if (array_key_exists('api_key', $_SESSION)) {
        $app->redirect('/menu');
    }
    
    $app->render('home.html.twig', [
        'page' => $page,
        'meta' => $meta,
        'error' => $_SESSION['error']
    ]);
    
    cheat\Session::clear();
    
})->name('home');

$app->post('/', function () use ($app) {
    
    $key = \filter_var(($app->request()->post('key')), FILTER_SANITIZE_STRING);
    
    $api = (new cheat\ApiCalls)->keyValidate($key);
    
    if (($key == "") || ($api == FALSE)) {
        $_SESSION['error'] = "Please enter your API key";
        $app->redirect('/');
    } else {
        cheat\Session::clear();
        $_SESSION['api_key'] = $key;
        $app->redirect('/menu');
    }
});