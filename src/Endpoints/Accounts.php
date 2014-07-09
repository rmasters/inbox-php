<?php

namespace Inbox\Endpoints;

use Inbox\Models\Account;

/**
 * Endpoints relating to Inbox Namespaces (email accounts)
 */
class Accounts extends Endpoint
{
    /**
     * Get all namespaces
     * @return Account[]
     */
    public function all()
    {
        $res = $this->getApiClient()->get('/n');

        return array_map(function ($account) {
            return Account::fromObject($account);
        }, $res->json());
    }

    /**
     * Get a namespace
     * @param $id
     * @return Account
     */
    public function get($id)
    {
        $res = $this->getApiClient()->get('/n/' . $id);

        return Account::fromObject($res->json());
    }
}