<?php

namespace Ihsanuddin\Model;

use Ihsan\UsernameGenerator\Repository\UsernameInterface;

class Username implements UsernameInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $fullName;

    /**
     * @var string
     */
    private $username;

    /**
     * @var \DateTime
     */
    private $birthDay;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @param string $fullName
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return \DateTime
     */
    public function getBirthDay()
    {
        return $this->birthDay;
    }

    /**
     * @param \DateTime $birthDay
     */
    public function setBirthDay(\DateTime $birthDay)
    {
        $this->birthDay = $birthDay;
    }
}
