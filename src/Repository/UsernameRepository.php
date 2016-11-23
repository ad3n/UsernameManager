<?php

namespace Ihsanuddin\Repository;

use Ihsan\UsernameGenerator\Repository\UsernameInterface;
use Ihsan\UsernameGenerator\Repository\UsernameRepositoryInterface;
use Ihsanuddin\Database\Database;
use Ihsanuddin\Model\OwnerInterface;
use Ihsanuddin\Model\Username;

class UsernameRepository implements UsernameRepositoryInterface
{
    /**
     * @var Database
     */
    private $database;

    /**
     * @var OwnerInterface
     */
    private $owner;

    /**
     * @param Database $database
     * @param OwnerInterface   $owner
     */
    public function __construct(Database $database, OwnerInterface $owner)
    {
        $this->database = $database;
        $this->owner = $owner;
    }

    /**
     * @param UsernameInterface $username
     */
    public function save(UsernameInterface $username)
    {
        $sql = <<<'SQLCODE'
INSERT INTO %owner% (
    username
)
VALUES (
    :username
);
SQLCODE;

        /** @var Username $username */
        if (empty($username->getOwner())) {
            $username->setOwner($this->owner);
        }

        $parameters = [
            'username' => $username->getUsername(),
        ];

        $this->database->execute(str_replace('%owner%', $username->getOwner()->getUsernameStorage(), $sql), $parameters);
    }

    /**
     * @param string $username
     *
     * @return bool
     */
    public function isExist($username)
    {
        $queryBuilder = $this->database->getQueryBuilder();
        $queryBuilder->from($this->owner->getUsernameStorage());
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
        $queryBuilder->from($this->owner->getUsernameStorage());
        $queryBuilder->where('username', 'LIKE', sprintf('%%%s%%', $characters));

        return $queryBuilder->count();
    }
}
