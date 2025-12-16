<?php
$app->getRouter()->get('/', 'HomeController@index');
$app->getRouter()->get('/home', 'HomeController@index');

$app->getRouter()->get('/register', 'RegistrationController@create');
$app->getRouter()->get('/login', 'LoginController@create');

