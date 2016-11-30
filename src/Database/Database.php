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
     */
    private function connect($host, $database, $username, $password = null, $driver = 'mysql', $port = 3306, $charset = 'utf8')
    {
        $config = [
            'driver' => $driver,
            'host' => $host,
            'database' => $database,
            'username' => $username,
            'password' => $password,
            'charset' => $charset,
            'port' => $port,
        ];

        $this->connection = new Connection('mysql', $config, 'DEFAULT');
    }

    /**
     * @param string $query
     * @param array  $parameters
     */
    public function execute($query, array $parameters = array())
    {
        $pdo = $this->connection->getPdoInstance();
        $statement = $pdo->prepare($query);

        foreach ($parameters as $parameter => $value) {
            $statement->bindValue(sprintf(':%s', $parameter), $value);
        }

        $statement->execute();
    }

    /**
     * @return QueryBuilderHandler
     */
    public function getQueryBuilder()
    {
        return new QueryBuilderHandler($this->connection);
    }
}
