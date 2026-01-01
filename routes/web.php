<?php
$app->getRouter()->get('/', 'HomeController@index');
$app->getRouter()->get('/home', 'HomeController@index');

$app->getRouter()->get('/register', 'RegistrationController@create');
$app->getRouter()->post('/register', 'RegistrationController@store');
$app->getRouter()->get('/login', 'LoginController@create');
$app->getRouter()->post('/login', 'LoginController@store');


$app->getRouter()->fallback('MainController@index');

