<?php

namespace Ihsanuddin\Model;

use Ihsan\UsernameGenerator\Repository\UsernameInterface;

class Username implements UsernameInterface
{
    /**
     * @return int
     */
    public function getId()
    {
        // TODO: Implement getId() method.
    }

    /**
     * @return OwnerInterface
     */
    public function getOwner()
    {
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        // TODO: Implement getFullName() method.
    }

    /**
     * @param string $fullName
     */
    public function setFullName($fullName)
    {
        // TODO: Implement setFullName() method.
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        // TODO: Implement getUsername() method.
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        // TODO: Implement setUsername() method.
    }

    /**
     * @return string
     */
    public function getBirthDay()
    {
        // TODO: Implement getBirthDay() method.
    }

    /**
     * @param \DateTime $date
     */
    public function setBirthDay(\DateTime $date)
    {
        // TODO: Implement setBirthDay() method.
    }
}
