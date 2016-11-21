<?php

$loader = require __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Ihsanuddin\Application;

$request = Request::createFromGlobals();

$app = new Application();

$app->route('/hello/{name}', function ($name) {
    return new Response('Hello '.$name);
});

$response = $app->handle($request);
$response->send();
