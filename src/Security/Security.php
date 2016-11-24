<?php

namespace Ihsanuddin\Security;

use Ihsanuddin\Model\OwnerInterface;
use Ihsanuddin\Repository\OwnerRepository;
use Symfony\Component\HttpFoundation\Request;

class Security
{
    /**
     * @var OwnerRepository
     */
    private $repository;

    /**
     * @var OwnerInterface
     */
    private $owner;

    public function __construct(OwnerRepository $repository)
    {
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
     * @return OwnerInterface
     */
    public function getOwner()
    {
        return $this->owner;
    }
}
