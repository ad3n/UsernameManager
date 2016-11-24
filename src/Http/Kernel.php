<?php

namespace Ihsanuddin\Http;

use Ihsanuddin\Event\GetResponseEvent;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

abstract class Kernel implements HttpKernelInterface
{
    const FILTER_REQUEST = 'pre_request';

    /**
     * @var RouteCollection
     */
    protected $routes;

    /**
     * @var EventDispatcher
     */
    protected $dispatcher;

    /**
     * @var UrlMatcher
     */
    protected $matcher;

    public function __construct()
    {
        $this->routes = new RouteCollection();
        $this->dispatcher = new EventDispatcher();
    }

    /**
     * @param Request $request
     * @param int     $type
     * @param bool    $catch
     *
     * @return Response
     */
    public function handle(Request $request, $type = HttpKernelInterface::MASTER_REQUEST, $catch = true)
    {
        $context = new RequestContext();
        $context->fromRequest($request);
        $this->matcher = new UrlMatcher($this->routes, $context);

        $filterRequest = new GetResponseEvent();
        $filterRequest->setRequest($request);
        /** @var GetResponseEvent $filterRequest */
        $filterRequest = $this->fire(self::FILTER_REQUEST, $filterRequest);

        if ($response = $filterRequest->getResponse()) {
            return $response;
        }

        try {
            $attributes = $this->matcher->match($request->getPathInfo());

            $controller = $attributes['_controller'];
            unset($attributes['_controller']);

            $response = call_user_func_array($controller, $attributes);
        } catch (ResourceNotFoundException $e) {
            $response = new Response('Not found!', Response::HTTP_NOT_FOUND);
        }

        return $response;
    }

    /**
     * @param string   $path
     * @param callable $controller
     */
    public function route($path, $controller)
    {
        if (!is_callable($controller)) {
            throw new \InvalidArgumentException(sprintf('%s is not callable.'));
        }

        $this->routes->add($path, new Route(
            $path,
            array('_controller' => $controller)
        ));
    }

    /**
     * @param string $event
     * @param callable $callback
     */
    public function on($event, $callback)
    {
        if (! is_callable($callback)) {
            throw new \InvalidArgumentException(sprintf('%s is not callable.'));
        }

        $this->dispatcher->addListener($event, $callback);
    }

    /**
     * @param string $eventName
     * @param Event $event
     *
     * @return Event
     */
    public function fire($eventName, Event $event)
    {
        return $this->dispatcher->dispatch($eventName, $event);
    }

    /**
     * @param string $url
     *
     * @return bool
     */
    public function match($url)
    {
        try {
            if (empty($this->matcher->match($url))) {
                return false;
            }

            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }
}
