<?php

namespace Ihsanuddin\Controller;

use Ihsan\UsernameGenerator\UsernameFactory;
use Ihsan\UsernameGenerator\Util\CharacterShifter;
use Ihsanuddin\Application;
use Ihsanuddin\Model\OwnerInterface;
use Ihsanuddin\Model\Username;
use Ihsanuddin\Repository\UsernameRepository;
use Symfony\Component\HttpFoundation\Request;

class UsernameController
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

    public function generate()
    {
        /** @var OwnerInterface $owner */
        $owner = unserialize($this->application->getSession()->get('owner'));
        $repository = new UsernameRepository($this->application->getDatabase(), $owner);
        $factory = new UsernameFactory($repository, new CharacterShifter(), Username::class);

        return $factory->generate($this->request->query->get('n'), \DateTime::createFromFormat('Y-m-d', $this->request->query->get('b')));
    }

    public function save($username)
    {
        $user = new Username();
        $user->setUsername($username);

        /** @var OwnerInterface $owner */
        $owner = unserialize($this->application->getSession()->get('owner'));
        $repository = new UsernameRepository($this->application->getDatabase(), $owner);
        $repository->save($user);
    }
}
