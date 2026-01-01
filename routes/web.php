<?php
$app->getRouter()->get('/', 'HomeController@index');
$app->getRouter()->get('/home', 'HomeController@index');

$app->getRouter()->get('/register', 'RegistrationController@create');
$app->getRouter()->post('/register', 'RegistrationController@store');
//$app->getRouter()->get('/api/login', 'LoginController@create');
$app->getRouter()->post('/login', 'LoginController@store');

// require_once __DIR__ . 'api.php';

$app->getRouter()->fallback('MainController@index');

