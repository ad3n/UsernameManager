<?php

$loader = require __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Ihsanuddin\Application;

$request = Request::createFromGlobals();

$app = new Application();

$app->route('/username/generate', function () use ($app, $request) {
    //todo
});

$app->route('/username/confirm/{username}', function () use ($app) {
    //todo
});

$response = $app->handle($request);
$response->send();
