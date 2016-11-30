<?php

namespace Ihsanuddin\Repository;

use Ihsanuddin\Database\Database;
use Ihsanuddin\Model\Owner;
use Ihsanuddin\Model\OwnerInterface;

class OwnerRepository
{
    const TABLE = 'owners';
    const ADMIN_API = 'xxx';
    const ADMIN_IP_ADDRESS = '127.0.0.1';

    /**
     * @var Database
     */
    private $database;

    /**
     * @param Database $database
     */
    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function save(OwnerInterface $owner)
    {
        $sql =
<<<'SQLCODE'
INSERT INTO %owner% (
    name,
    email,
    ip_address,
    api,
    username_storage
) VALUES (
    :name,
    :email,
    :ipAddress,
    :api,
    :usernameStorage
);
SQLCODE;

        $parameters = [
            'name' => $owner->getName(),
            'email' => $owner->getEmail(),
            'ipAddress' => $owner->getIpAddress(),
            'api' => sha1(sprintf('%s%s%s', self::TABLE, $owner->getUsernameStorage(), microtime())),
            'usernameStorage' => $owner->getUsernameStorage(),
        ];

        $this->database->execute(str_replace('%owner%', self::TABLE, $sql), $parameters);
    }

    public function edit(OwnerInterface $owner)
    {
        $sql =
<<<'SQLCODE'
UPDATE 
    %owner% 
SET
    name = :name,
    email = :email,
    ip_address = :ipAddress,
    api = :api
WHERE
    id = :id
;
SQLCODE;

        $parameters = [
            'name' => $owner->getName(),
            'email' => $owner->getEmail(),
            'ipAddress' => $owner->getIpAddress(),
            'api' => $owner->getApi(),
            'id' => $owner->getId(),
        ];

        $this->database->execute(str_replace('%owner%', self::TABLE, $sql), $parameters);
    }

    public function delete(OwnerInterface $owner)
    {
        $sql =
<<<'SQLCODE'
DELETE FROM 
    %owner%
WHERE
    id = :id
;
SQLCODE;

        $parameters = ['id' => $owner->getId()];

        $this->database->execute(str_replace('%owner%', self::TABLE, $sql), $parameters);
    }

    /**
     * @param $id
     *
     * @return Owner|null
     */
    public function find($id)
    {
        $queryBuilder = $this->database->getQueryBuilder();
        $queryBuilder->from(self::TABLE);
        $queryBuilder->where('id', '=', $id);

        $result = $queryBuilder->get();
        if (!$result) {
            return $result;
        }

        return $this->normalize($result[0]);
    }

    /**
     * @param string $apiKey
     * @param string $ipAddress
     *
     * @return Owner|null
     */
    public function findByApiAndIpAddress($apiKey, $ipAddress)
    {
        $queryBuilder = $this->database->getQueryBuilder();
        $queryBuilder->from(self::TABLE);
        $queryBuilder->where('api', '=', $apiKey);
        $queryBuilder->where('ip_address', '=', $ipAddress);

        $result = $queryBuilder->get();
        if (!$result) {
            if ($apiKey === self::ADMIN_API && $ipAddress === self::ADMIN_IP_ADDRESS) {
                $owner = new Owner();
                $owner->setIpAddress($ipAddress);
                $owner->setApi($apiKey);

                return $owner;
            }

            return $result;
        }

        return $this->normalize($result[0]);
    }

    /**
     * @param array $keywords
     *
     * @return array|null
     */
    public function findAll(array $keywords = array())
    {
        $queryBuilder = $this->database->getQueryBuilder();
        $queryBuilder->from(self::TABLE);

        foreach ($keywords as $field => $keyword) {
            if (in_array($field, array('name', 'email', 'ip_address')) && $keyword) {
                $queryBuilder->where($field, 'LIKE', sprintf('%%%s%%', $keyword));
            }
        }

        $results = $queryBuilder->get();
        if (!$results) {
            return $results;
        }

        $outputs = [];
        foreach ($results as $result) {
            $outputs[] = $this->normalize($result);
        }

        return $outputs;
    }

    /**
     * @param \stdClass $data
     *
     * @return Owner
     */
    private function normalize(\stdClass $data)
    {
        $owner = new Owner();
        $owner->setId($data->id);
        $owner->setName($data->name);
        $owner->setEmail($data->email);
        $owner->setIpAddress($data->ip_address);
        $owner->setApi($data->api);
        $owner->setUsernameStorage($data->username_storage);

        return $owner;
    }
}
