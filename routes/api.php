<?php
$app->getRouter()->get('/api/platforms', 'api\\PlatformsController@get');

$app->getRouter()->get('/api/about', 'api\\AboutController@get');
$app->getRouter()->put('/api/about', 'api\\AboutController@update');
$app->getRouter()->delete('/api/about', 'api\\AboutController@delete');

$app->getRouter()->get('/api/title', 'api\\TitleController@get');
$app->getRouter()->put('/api/title', 'api\\TitleController@update');
$app->getRouter()->delete('/api/title', 'api\\TitleController@delete');

$app->getRouter()->post('/api/services', 'api\\ServicesController@store');
$app->getRouter()->get('/api/services', 'api\\ServicesController@get');
$app->getRouter()->delete('/api/services', 'api\\ServicesController@delete');

$app->getRouter()->post('/api/references', 'api\\ReferencesController@store');
$app->getRouter()->get('/api/references', 'api\\ReferencesController@get');
$app->getRouter()->delete('/api/references', 'api\\ReferencesController@delete');

$app->getRouter()->post('/api/links', 'api\\LinksController@store');
$app->getRouter()->get('/api/links', 'api\\LinksController@get');
$app->getRouter()->delete('/api/links', 'api\\LinksController@delete');

$app->getRouter()->put('/api/templates', 'api\\TemplatesController@update');
