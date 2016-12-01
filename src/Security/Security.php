<?php

namespace Ihsanuddin\Security;

use Ihsanuddin\Application;
use Ihsanuddin\Model\OwnerInterface;
use Ihsanuddin\Repository\OwnerRepository;
use Symfony\Component\HttpFoundation\Request;

class Security
{
    /**
     * @var Application
     */
    private $application;

    /**
     * @var OwnerRepository
     */
    private $repository;

    /**
     * @var OwnerInterface
     */
    private $owner;

    /**
     * @param Application $application
     * @param OwnerRepository $repository
     */
    public function __construct(Application $application, OwnerRepository $repository)
    {
        $this->application = $application;
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    public function isGranted(Request $request)
    {
        $owner = $this->repository->findByApiAndIpAddress($request->query->get('api'), $request->getClientIp());
        if (!$owner instanceof OwnerInterface) {
            return false;
        }

        $this->owner = $owner;

        return true;
    }

    /**
     * @param OwnerInterface $owner
     *
     * @return bool
     */
    public function isAdmin(OwnerInterface $owner = null)
    {
        if (null === $owner) {
            $owner = unserialize($this->application->getSession()->get('owner'));
        }

        if (!$owner) {
            return false;
        }

        if ($owner->getApi() === OwnerRepository::ADMIN_API && $owner->getIpAddress() === OwnerRepository::ADMIN_IP_ADDRESS) {
            return true;
        }

        return false;
    }

    /**
     * @return OwnerInterface
     */
    public function getOwner()
    {
        return $this->owner;
    }
}
