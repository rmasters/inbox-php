<?php

namespace Inbox\Endpoints;

use GuzzleHttp\Client;
use Inbox\Models\Account;
use Inbox\Models\Thread;

class Threads extends Endpoint
{
    /** @var Account */
    protected $account;

    /**
     * @param Client $apiClient
     * @param Account $account
     */
    public function __construct(Client $apiClient, Account $account)
    {
        parent::__construct($apiClient);

        $this->account = $account;
    }

    /**
     * @return Thread[]
     */
    public function all()
    {
        $res = $this->getApiClient()->get(sprintf('/n/%s/threads', $this->account->getId()));

        return array_map(function ($message) {
            return Thread::fromObject($message);
        }, $res->json());
    }

    /**
     * @param string $id
     * @return Thread
     */
    public function get($id)
    {
        $res = $this->getApiClient()->get(sprintf('/n/%s/threads/%s', $this->account->getId(), $id));

        return Thread::fromObject($res->json());
    }
}