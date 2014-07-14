<?php

namespace Inbox\Tests\Endpoints;

class ThreadsTest extends EndpointBase
{
    public function testGetThreads()
    {
        $threads = $this->getInbox()->threads($this->getAccount())->all();

        $this->assertCount(25, $threads);
        $this->assertInstanceOf('Inbox\Models\Thread', $threads[0]);
    }

    public function testGetThread()
    {
        $message = $this->getInbox()->messages($this->getAccount())->get($this->getMessage());
        $thread = $this->getInbox()->threads($this->getAccount())->get($message->getThread()->getId());

        $this->assertInstanceOf('Inbox\Models\Thread', $thread);
        $this->assertEquals($message->getThread()->getId(), $thread->getId());
    }
}