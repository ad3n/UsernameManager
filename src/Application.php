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

    /**
     * @var \Twig_Environment
     */
    private $template;

    /**
     * @param string|null $templatePath
     */
    public function __construct($templatePath = null)
    {
        parent::__construct();

        $this->database = new Database(self::HOST, self::DATABASE, self::USERNAME);
        $this->session = new Session();

        if (null === $templatePath) {
            $templatePath = __DIR__.'/../html';
        }

        $loader = new \Twig_Loader_Filesystem($templatePath);
        $this->template = new \Twig_Environment($loader, array(
            'cache' => __DIR__.'/../cache',
        ));

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

    /**
     * @return \Twig_Environment
     */
    public function getTemplate()
    {
        return $this->template;
    }
}
