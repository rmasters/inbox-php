<?php

namespace Inbox\Endpoints;

use GuzzleHttp\Client;
use Inbox\Models\Account;
use Inbox\Models\Message;

class Messages extends Endpoint
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
     * @return Message[]
     */
    public function all()
    {
        $res = $this->getApiClient()->get(sprintf('/n/%s/messages', $this->account->getId()));

        return array_map(function ($message) {
            return Message::fromObject($message);
        }, $res->json());
    }

    /**
     * @param string $id
     * @return Message
     */
    public function get($id)
    {
        $res = $this->getApiClient()->get(sprintf('/n/%s/messages/%s', $this->account->getId(), $id));

        return Message::fromObject($res->json());
    }
}