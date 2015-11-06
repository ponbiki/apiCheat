<?php

use ponbiki\apiCheat as cheat;

new cheat\Session();

if (!array_key_exists('error', $_SESSION)) {
    $_SESSION['error'] = [];
}

$app->get('/', function () use ($app) {
    
    $page = "Api Key Entry";
    $meta = "Login";
    
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
    
    if ($key == "") {
        $_SESSION['error'][] = "Please enter your API key";
        $app->redirect('/');
    } elseif ($api == FALSE) {
        $_SESSION['error'][] = "Key invalid. Please re-enter your API key";
        $app->redirect('/');
    } else {
        cheat\Session::clear();
        $_SESSION['api_key'] = $key;
        $_SESSION['loggedin'] = TRUE;
        $app->redirect('/menu');
    }
});