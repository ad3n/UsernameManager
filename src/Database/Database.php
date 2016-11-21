<?php

namespace Ihsanuddin\Database;

use Pixie\Connection;
use Pixie\QueryBuilder\QueryBuilderHandler;

class Database
{
    /**
     * @var Connection
     */
    private $connection;

    /**
     * @param string $host
     * @param string $database
     * @param string $username
     * @param null   $password
     * @param string $driver
     * @param int    $port
     * @param string $charset
     */
    public function __construct($host, $database, $username, $password = null, $driver = 'mysql', $port = 3306, $charset = 'utf8')
    {
        $this->connect($host, $database, $username, $password, $driver, $port, $charset);
    }

    /**
     * @param string $host
     * @param string $database
     * @param string $username
     * @param null   $password
     * @param string $driver
     * @param int    $port
     * @param string $charset
     *
     * @return Database
     */
    private function connect($host, $database, $username, $password = null, $driver = 'mysql', $port = 3306, $charset = 'utf8')
    {
        $config = [
            'database_type' => $driver,
            'database_name' => $database,
            'server' => $host,
            'username' => $username,
            'password' => $password,
            'charset' => $charset,
            'port' => $port,
        ];

        $this->connection = new Connection('mysql', $config, 'DEFAULT');

        return $this;
    }

    /**
     * @param string $query
     */
    public function execute($query)
    {
        $pdo = $this->connection->getPdoInstance();
        $pdo->prepare($query)->execute();
    }

    /**
     * @return QueryBuilderHandler
     */
    public function getQueryBuilder()
    {
        return new QueryBuilderHandler($this->connection);
    }
}
