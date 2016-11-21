<?php

namespace Ihsanuddin;

use Ihsanuddin\Database\Database;
use Ihsanuddin\Http\Kernel;

class Application extends Kernel
{
    const DATABASE = 'username_management';
    const HOST = 'localhost';
    const USERNAME = 'root';

    /**
     * @var Database
     */
    private $database;

    public function __construct()
    {
        parent::__construct();

        $this->database = new Database(self::HOST, self::DATABASE, self::USERNAME);
    }

    /**
     * @return Database
     */
    public function getDatabase()
    {
        return $this->database;
    }
}
