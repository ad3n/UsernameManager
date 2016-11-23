<?php

namespace Ihsanuddin\Repository;

use Ihsan\UsernameGenerator\Repository\UsernameInterface;
use Ihsan\UsernameGenerator\Repository\UsernameRepositoryInterface;
use Ihsanuddin\Database\Database;
use Ihsanuddin\Model\Username;

class UsernameRepository implements UsernameRepositoryInterface
{
    /**
     * @var Database
     */
    private $database;

    /**
     * @var string
     */
    private $table;

    /**
     * @param Database $database
     * @param string   $table
     */
    public function __construct(Database $database, $table)
    {
        $this->database = $database;
        $this->table = $table;
    }

    /**
     * @param UsernameInterface $username
     */
    public function save(UsernameInterface $username)
    {
        $sql = <<<'SQLCODE'
INSERT INTO %table% (
    username,
)
VALUES (
    :username
);
SQLCODE;

        /** @var Username $username */
        if (empty($username->getOwner())) {
            throw new \InvalidArgumentException(sprintf('User %s have not owner.', $username->getUsername()));
        }

        $parameters = [
            'username' => $username->getUsername(),
        ];

        $this->database->execute(str_replace('%table%', $username->getOwner()->getUsernameStorage(), $sql), $parameters);
    }

    /**
     * @param string $username
     *
     * @return bool
     */
    public function isExist($username)
    {
        $queryBuilder = $this->database->getQueryBuilder();
        $queryBuilder->from($this->table);
        $queryBuilder->where('username', '=', $username);

        $result = $queryBuilder->get();
        if (empty($result)) {
            return false;
        }

        return true;
    }

    /**
     * @param int $characters
     *
     * @return int
     */
    public function countUsage($characters)
    {
        $queryBuilder = $this->database->getQueryBuilder();
        $queryBuilder->from($this->table);
        $queryBuilder->where('username', 'LIKE', sprintf('%%%s%%', $characters));

        return $queryBuilder->count();
    }
}
