<?php

$loader = require __DIR__.'/../vendor/autoload.php';

use Ihsanuddin\Application;
use Ihsanuddin\Event\GetResponseEvent;
use Ihsanuddin\Repository\OwnerRepository;
use Ihsanuddin\Security\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException;
use Ihsanuddin\Controller\UsernameController;
use Ihsanuddin\Controller\OwnerController;

$request = Request::createFromGlobals();
$app = new Application();

$app->route('/username/generate', function () use ($app, $request) {
    if (!($request->query->get('n') || $request->query->get('b'))) {
        throw new NotAcceptableHttpException();
    }

    $controller = new UsernameController($app, $request);
    $username = $controller->generate();
    if (!$username) {
        return new JsonResponse(array(
            'status' => 'KO',
            'message' => 'Username yang sesuai tidak ditemukan.',
        ));
    }

    return new JsonResponse(array(
        'status' => 'OK',
        'message' => $username,
    ));
}, array('GET'));

$app->route('/username/confirm/{username}', function ($username) use ($app, $request) {
    $controller = new UsernameController($app, $request);
    $controller->save($username);

    return new JsonResponse(array(
        'status' => 'OK',
        'message' => sprintf('Username %s berhasil disimpan.', $username),
    ), Response::HTTP_CREATED);
}, array('POST'));

$app->route('/owner', function () use ($app, $request) {
    $controller = new OwnerController($app, $request);

    return new Response($controller->index());
}, array('GET'));

$app->route('/owner/create', function () use ($app, $request) {
    $controller = new OwnerController($app, $request);
    $controller->save();

    return new JsonResponse(array(
        'status' => 'OK',
        'message' => 'Owner berhasil disimpan.',
    ), Response::HTTP_CREATED);
}, array('POST'));

$app->route('/owner/edit/{id}', function ($id) use ($app, $request) {
    $controller = new OwnerController($app, $request);
    $response = $controller->edit($id);

    return new JsonResponse($response, Response::HTTP_OK);
}, array('PUT'));

$app->route('/owner/delete/{id}', function ($id) use ($app, $request) {
    $controller = new OwnerController($app, $request);
    $response = $controller->delete($id);

    return new JsonResponse($response, Response::HTTP_OK);
}, array('DELETE'));

$app->on(Application::FILTER_REQUEST, function (GetResponseEvent $event) use ($app) {
    $security = new Security($app, new OwnerRepository($app->getDatabase()));
    if (!$security->isGranted($event->getRequest())) {
        $event->setResponse(new Response('Access Denied.', Response::HTTP_FORBIDDEN));

        return;
    }

    $session = $app->getSession();
    $session->set('owner', serialize($security->getOwner()));
});

$app->on(Application::FILTER_REQUEST, function (GetResponseEvent $event) use ($app) {
    $security = new Security($app, new OwnerRepository($app->getDatabase()));
    if (!$security->isAdmin() && preg_match('#owner#', $event->getRequest()->getPathInfo())) {
        $event->setResponse(new Response('Access Denied.', Response::HTTP_FORBIDDEN));
    }
});

$app->on(Application::FILTER_REQUEST, function (GetResponseEvent $event) {
    $request = $event->getRequest();
    if ($owner = $request->get('owner')) {
        if (!array_key_exists('email', $owner) || FALSE === filter_var($owner['email'], FILTER_VALIDATE_EMAIL)) {
            $event->setResponse(new JsonResponse(array(
                'status' => 'KO',
                'message' => 'Email tidak valid.',
            ), Response::HTTP_BAD_REQUEST));

            return;
        }

        if (!array_key_exists('ip_address', $owner) || FALSE === filter_var($owner['ip_address'], FILTER_VALIDATE_IP)) {
            $event->setResponse(new JsonResponse(array(
                'status' => 'KO',
                'message' => 'Ip Address tidak valid.',
            ), Response::HTTP_BAD_REQUEST));

            return;
        }
    }
});

$response = $app->handle($request);
$response->send();

