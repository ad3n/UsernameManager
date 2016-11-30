<?php

namespace Ihsanuddin\Controller;

use Ihsanuddin\Application;
use Ihsanuddin\Model\Owner;
use Ihsanuddin\Model\OwnerInterface;
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
        $ownerRepository = new OwnerRepository($this->application->getDatabase());

        return $this->application->getTemplate()->render('index.html.twig', array('owners' => $ownerRepository->findAll($this->request->query->get('filters', array()))));
    }

    public function save()
    {
        $ownerRepository = new OwnerRepository($this->application->getDatabase());
        $owner = $this->getOwner($this->request);

        UsernameTableCreator::create($this->application->getDatabase(), $owner);

        $ownerRepository->save($owner);
    }

    public function edit($id)
    {
        $ownerRepository = new OwnerRepository($this->application->getDatabase());
        $owner = $ownerRepository->find($id);

        if (!$owner) {
            return array(
                'status' => false,
                'message' => 'Owner tidak ditemukan.',
            );
        }

        $owner = $this->getOwner($this->request, $owner);
        $ownerRepository->edit($owner);

        return array(
            'status' => true,
            'message' => 'Owner berhasil diupdate.',
        );
    }

    public function delete($id)
    {
        $ownerRepository = new OwnerRepository($this->application->getDatabase());
        $owner = $ownerRepository->find($id);

        if (!$owner) {
            return array(
                'status' => false,
                'message' => 'Owner tidak ditemukan.',
            );
        }

        $owner = $this->getOwner($this->request, $owner);
        $ownerRepository->delete($owner);

        return array(
            'status' => true,
            'message' => 'Owner berhasil dihapus.',
        );
    }

    private function getOwner(Request $request, OwnerInterface $owner = null)
    {
        $ownerRequest = $request->get('owner');

        if (!$owner instanceof OwnerInterface) {
            $owner = new Owner();
        }

        $owner->setName($ownerRequest['name']);
        $owner->setEmail($ownerRequest['email']);
        $owner->setIpAddress($ownerRequest['ip_address']);

        return $owner;
    }
}
