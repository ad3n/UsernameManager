<?php

namespace Ihsanuddin\Util;

use Ihsanuddin\Database\Database;
use Ihsanuddin\Model\OwnerInterface;

class UsernameTableCreator
{
    /**
     * @param Database       $database
     * @param OwnerInterface $owner
     */
    public static function create(Database $database, OwnerInterface $owner)
    {
        $sql =
<<<'SQLCODE'
CREATE TABLE %table%
(
    username VARCHAR(12) PRIMARY KEY NOT NULL
);
SQLCODE;
        $table = sprintf('username_%s', $owner->getId());

        try {
            $database->execute(str_replace('%table%', $table, $sql));
            $owner->setUsernameStorage($table);
        } catch (\PDOException $exception) {
            echo $exception->getTraceAsString();
            exit();
        }
    }
}
