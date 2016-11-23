<?php

namespace Ihsanuddin;

use Ihsanuddin\Database\Database;
use Ihsanuddin\Http\Kernel;
use Symfony\Component\HttpFoundation\Session\Session;

class Application extends Kernel
{
    const DATABASE = 'username_management';
    const HOST = 'localhost';
    const USERNAME = 'root';

    /**
     * @var Database
     */
    private $database;

    /**
     * @var Session
     */
    private $session;

    public function __construct()
    {
        parent::__construct();

        $this->database = new Database(self::HOST, self::DATABASE, self::USERNAME);
        $this->session = new Session();
    }

    /**
     * @return Database
     */
    public function getDatabase()
    {
        return $this->database;
    }

    /**
     * @return Session
     */
    public function getSession()
    {
        return $this->session;
    }
}
