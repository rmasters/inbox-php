<?php

namespace Inbox\Tests\Endpoints;

class MessagesTest extends EndpointBase
{
    public function setUp()
    {
        parent::setUp();

        if (!$this->getAccount()) {
            $this->markTestSkipped("Can't run functional tests without an account id");
        }
    }

    public function testGetMessages()
    {
        $messages = $this->getInbox()->messages($this->getAccount())->all();

        $this->assertGreaterThan(0, count($messages));
    }

    public function testGetMessage()
    {
        if (!$this->getMessage()) {
            $this->markTestSkipped("Can't run functional test without a message id");
        }

        $message = $this->getInbox()->messages($this->getAccount())->get($this->getMessage());

        $this->assertInstanceOf('Inbox\Models\Message', $message);
        $this->assertEquals($this->getMessage(), $message->getId());
    }
}