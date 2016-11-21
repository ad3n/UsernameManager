<?php

namespace Ihsanuddin\Database;

class Database
{
    /**
     * @var \medoo
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
        $this->connection = new \medoo([
            'database_type' => $driver,
            'database_name' => $database,
            'server' => $host,
            'username' => $username,
            'password' => $password,
            'charset' => $charset,
            'port' => $port,
        ]);

        return $this;
    }

    /**
     * @param string $table
     * @param array  $data
     */
    public function save($table, array $data)
    {
        $this->connection->insert($table, $data);
    }

    /**
     * @param string $table
     */
    public function create($table)
    {
        $this->connection->exec(sprintf('CREATE TABLE %s', $table));
    }

    /**
     * @param string $table
     * @param null   $columns
     * @param array  $wheres
     */
    public function get($table, $columns = null, $wheres = array())
    {
        $this->connection->get($table);
    }
}
