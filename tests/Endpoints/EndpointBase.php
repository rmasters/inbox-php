<?php

namespace Inbox\Tests\Endpoints;

use Inbox\Inbox;

class EndpointBase extends \PHPUnit_Framework_TestCase
{
    /** @var Inbox */
    private $inbox;
    /** @var string */
    private $accountId;
    /** @var string */
    private $messageId;

    /**
     * Configure an Inbox connection to the server defined in phpunit.xml.
     * Skip the test if no server is configured.
     */
    public function setUp()
    {
        $server = getenv('INBOX_SERVER');
        if (!$server) {
            $this->markTestSkipped('No Inbox server was configured');
        }

        $this->accountId = getenv('INBOX_ACCOUNT');
        $this->messageId = getenv('INBOX_MESSAGE');

        $this->inbox = new Inbox($server);
    }

    /**
     * @return Inbox
     */
    protected function getInbox()
    {
        return $this->inbox;
    }

    /**
     * @return string Account ID to use for tests
     */
    protected function getAccount()
    {
        return $this->accountId;
    }

    /**
     * @return string Message ID to use for tests
     */
    protected function getMessage()
    {
        return $this->messageId;
    }
}