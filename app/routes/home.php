<?php

use ns1\apiCheat as cheat;

new cheat\Session();

$app->get('/', function () use ($app) {
    
    $page = "Api Key Entry";
    $meta = "Login";
    
    if (array_key_exists('loggedin', $_SESSION)) {
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
    
    $check_key = \filter_var(($app->request()->post('key')), FILTER_SANITIZE_STRING);
    
    if ($check_key == "") {
        $_SESSION['error'][] = "Please enter your API key";
        $app->redirect('/');
    }
    
    $_SESSION['api'] = new cheat\ApiCalls();
    $valid_key = $_SESSION['api']->keyValidate($check_key);
    
    if ($valid_key === \FALSE) {
        $_SESSION['error'][] = "Key invalid. Please re-enter your API key";
        unset($_SESSION['api']);
        $app->redirect('/');
    } else {
        cheat\Session::clear();
        $_SESSION['loggedin'] = \TRUE;
        $app->redirect('/menu');
    }
});