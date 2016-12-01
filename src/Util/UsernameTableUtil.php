<?php

namespace Ihsanuddin\Util;

use Ihsanuddin\Database\Database;
use Ihsanuddin\Model\OwnerInterface;

class UsernameTableUtil
{
    /**
     * @param Database       $database
     * @param OwnerInterface $owner
     */
    public static function create(Database $database, OwnerInterface $owner)
    {
        $sql =
<<<'SQLCODE'
CREATE TABLE %owner%
(
    username VARCHAR(12) PRIMARY KEY NOT NULL
);
SQLCODE;
        $table = sprintf('username_%s', sha1(serialize($owner)));

        try {
            $database->execute(str_replace('%owner%', $table, $sql));
            $owner->setUsernameStorage($table);
        } catch (\PDOException $exception) {
            echo $exception->getTraceAsString();
            exit();
        }
    }
    /**
     * @param Database       $database
     * @param OwnerInterface $owner
     */
    public static function drop(Database $database, OwnerInterface $owner)
    {
        $sql =
<<<'SQLCODE'
DROP TABLE %owner%;
SQLCODE;

        try {
            $database->execute(str_replace('%owner%', $owner->getUsernameStorage(), $sql));
        } catch (\PDOException $exception) {
            echo $exception->getTraceAsString();
            exit();
        }
    }
}
