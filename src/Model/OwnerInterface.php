<?php

namespace Ihsanuddin\Model;

interface OwnerInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function getEmail();

    /**
     * @return string
     */
    public function getIpAddress();

    /**
     * @return string
     */
    public function getApi();

    /**
     * @return string
     */
    public function getUsernameStorage();
}
