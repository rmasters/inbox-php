<?php

namespace Inbox;

use GuzzleHttp\Client as GuzzleClient;
use Inbox\Endpoints;
use Inbox\Models;

class Inbox
{
    const INBOX_BASE_URL = 'https://inboxapp.com';

    /** @var string */
    protected $baseUrl;
    /** @var GuzzleClient */
    protected $apiClient;

    /**
     * @param string|null $baseUrl The Inbox server to use
     */
    public function __construct($baseUrl=null)
    {
        $this->baseUrl = $baseUrl ?: static::INBOX_BASE_URL;
        $this->apiClient = $this->createApiClient();
    }

    /**
     * Create a new Guzzle client
     * @return GuzzleClient
     */
    private function createApiClient()
    {
        $client = new GuzzleClient(['base_url' => $this->baseUrl]);

        return $client;
    }

    /**
     * Get Namespace endpoints
     * @return Endpoints\Accounts
     */
    public function accounts()
    {
        return new Endpoints\Accounts($this->apiClient);
    }

    /**
     * Get Message endpoints
     * @param Models\Account|string $account Account or account id
     * @return Endpoints\Messages
     */
    public function messages($account)
    {
        if (!$account instanceof Models\Account) {
            $account = new Models\Account($account);
        }

        return new Endpoints\Messages($this->apiClient, $account);
    }

    /**
     * Get Thread endpoints
     * @param Models\Account|string $account Account or account id
     * @return Endpoints\Messages
     */
    public function threads($account)
    {
        if (!$account instanceof Models\Account) {
            $account = new Models\Account($account);
        }

        return new Endpoints\Threads($this->apiClient, $account);
    }
}
