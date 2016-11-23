<?php

$loader = require __DIR__.'/../vendor/autoload.php';

use Ihsanuddin\Application;
use Ihsanuddin\Event\GetResponseEvent;
use Ihsanuddin\Security\Security;
use Ihsanuddin\Repository\OwnerRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

$request = Request::createFromGlobals();
$app = new Application();

$app->route('/username/generate', function () use ($app, $request) {
    //todo
});

$app->route('/username/confirm/{username}', function () use ($app) {
    //todo
});

$app->on(Application::FILTER_REQUEST, function (GetResponseEvent $event) use ($app) {
    $security = new Security(new OwnerRepository($app->getDatabase()));
    if (!$security->isGranted($event->getRequest())) {
        $event->setResponse(new Response('Access Denied.', Response::HTTP_FORBIDDEN));

        return;
    }

    $session = new Session();
    $session->set('username', serialize($security->getOwner()));
});

$response = $app->handle($request);
$response->send();
