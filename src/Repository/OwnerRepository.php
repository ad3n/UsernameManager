<?php

namespace Ihsanuddin\Repository;

use Ihsanuddin\Database\Database;
use Ihsanuddin\Model\Owner;
use Ihsanuddin\Model\OwnerInterface;

class OwnerRepository
{
    const TABLE = 'owners';

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
INSERT INTO %table% (
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
            'api' => $owner->getApi(),
            'usernameStorage' => $owner->getUsernameStorage(),
        ];

        $this->database->execute(str_replace('%table%', self::TABLE, $sql), $parameters);
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

        return $this->normalize($result);
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
            return $result;
        }

        return $this->normalize($result);
    }

    /**
     * @return array|null
     */
    public function findAll()
    {
        $queryBuilder = $this->database->getQueryBuilder();
        $queryBuilder->from(self::TABLE);

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
