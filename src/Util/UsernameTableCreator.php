<?php

namespace Ihsanuddin\Util;

use Ihsanuddin\Database\Database;
use Ihsanuddin\Model\OwnerInterface;

class UsernameTableCreator
{
    /**
     * @param Database $database
     * @param OwnerInterface $owner
     */
    public static function create(Database $database, OwnerInterface $owner)
    {
        $raw =
<<<SQLCODE
CREATE TABLE username_%owner%
(
    id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    owner_id INT(11) NOT NULL,
    full_name VARCHAR(255) NOT NULL,
    username VARCHAR(12) NOT NULL,
    birth_day DATE NOT NULL
);
SQLCODE;

        $sql = str_replace('%owner%', $owner->getId(), $raw);

        try {
            $database->execute($sql);
        } catch (\PDOException $exception) {
            echo $exception->getTraceAsString();
            exit();
        }
    }
}
