<?php

namespace Ihsanuddin\Controller;

use Ihsanuddin\Application;
use Ihsanuddin\Model\Owner;
use Ihsanuddin\Repository\OwnerRepository;
use Ihsanuddin\Util\UsernameTableCreator;
use Symfony\Component\HttpFoundation\Request;

class OwnerController
{
    /**
     * @var Application
     */
    private $application;

    /**
     * @var Request
     */
    private $request;

    /**
     * @param Application $application
     * @param Request $request
     */
    public function __construct(Application $application, Request $request)
    {
        $this->application = $application;
        $this->request = $request;
    }

    public function index()
    {
        return $this->application->getTemplate()->render('index.html.twig');
    }

    public function save()
    {
        $ownerRepository = new OwnerRepository($this->application->getDatabase());
        $owner = $this->getOwner($this->request);

        UsernameTableCreator::create($this->application->getDatabase(), $owner);

        $ownerRepository->save($owner);
    }

    private function getOwner(Request $request)
    {
        $ownerRequest = $request->get('owner');

        $owner = new Owner();
        $owner->setName($ownerRequest['name']);
        $owner->setEmail($ownerRequest['email']);
        $owner->setIpAddress($ownerRequest['ip']);
        $owner->setApi($ownerRequest['api']);

        return $owner;
    }
}
