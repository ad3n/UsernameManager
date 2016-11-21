<?php

namespace Repository;

use Ihsanuddin\Database\Database;

class OwnerRepository
{
    /**
     * @var Database
     */
    private $database;

    /**
     * @param Database $database
     */
    public function __construct(Database $database)
    {
        $this->database = $database;
    }
}
