<?php

namespace Inbox\Endpoints;

use GuzzleHttp\Client;

class Endpoint
{
    /** @var Client */
    private $apiClient;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->apiClient = $client;
    }

    /**
     * @return Client
     */
    protected function getApiClient()
    {
        return $this->apiClient;
    }
}