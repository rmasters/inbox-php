<?php

namespace Inbox\Tests\Models;

use Inbox\Models\Thread;

class ThreadTest extends \PHPUnit_Framework_TestCase
{
    public function testThreadFromObject()
    {
        $payload = <<<JSON
{
    "drafts": [
        "2blbv3p6ifr7ten9osd79ifwp"
    ],
    "id": "defovdks6zrxnevdwpi2w5bs9",
    "last_message_timestamp": 1404926309,
    "messages": [
        "1blbv3p6ifr7ten9osd79ifwp"
    ],
    "namespace": "dl94uah9mve0j055l7zuokr2x",
    "object": "thread",
    "participants": [
        {
            "email": "gemma@example.com",
            "name": "Example.com"
        },
        {
            "email": "ross@example.com",
            "name": "Ross Masters"
        }
    ],
    "snippet": "/* Hotmail fix */ .ReadMsgBody { width: 100%;} .ExternalClass {width: 100%;} * { margin: 0; padding: 0;} New results today for your Saved Search ",
    "subject": "Saved search - 15 new ads",
    "subject_date": 1404926309,
    "tags": [
        {
            "id": "unseen",
            "name": "unseen"
        },
        {
            "id": "inbox",
            "name": "inbox"
        },
        {
            "id": "unread",
            "name": "unread"
        },
        {
            "id": "all",
            "name": "all"
        },
        {
            "id": "important",
            "name": "important"
        }
    ]
}
JSON;

        $thread = Thread::fromObject(json_decode($payload, true));
        $this->assertInstanceOf('Inbox\Models\Thread', $thread);
        $this->assertEquals('defovdks6zrxnevdwpi2w5bs9', $thread->getId());
        $this->assertInstanceOf('Inbox\Models\Account', $thread->getAccount());
        $this->assertEquals('dl94uah9mve0j055l7zuokr2x', $thread->getAccount()->getId());
        $this->assertEquals('Saved search - 15 new ads', $thread->getSubject());
        $this->assertInstanceOf('DateTime', $thread->getLastMessage());
        $this->assertEquals('2014-07-09T17:18:29+00:00', $thread->getLastMessage()->format('c'));
        $this->assertInternalType('array', $thread->getParticipants());
        $this->assertCount(2, $thread->getParticipants());
        $this->assertEquals('gemma@example.com', $thread->getParticipants()[0]->getEmail());
        $this->assertContains('New results today', $thread->getSnippet());
        $this->assertInternalType('array', $thread->getTags());
        $this->assertCount(5, $thread->getTags());
        $this->assertInstanceOf('Inbox\Models\Tag', $thread->getTags()[0]);
        $this->assertEquals('unseen', $thread->getTags()[0]->getId());
        $this->assertInternalType('array', $thread->getMessages());
        $this->assertCount(1, $thread->getMessages());
        $this->assertInstanceOf('Inbox\Models\Message', $thread->getMessages()[0]);
        $this->assertEquals('1blbv3p6ifr7ten9osd79ifwp', $thread->getMessages()[0]->getId());
        $this->assertInternalType('array', $thread->getDrafts());
        $this->assertCount(1, $thread->getDrafts());
        $this->assertInstanceOf('Inbox\Models\Draft', $thread->getDrafts()[0]);
        $this->assertEquals('2blbv3p6ifr7ten9osd79ifwp', $thread->getDrafts()[0]->getId());
    }
}