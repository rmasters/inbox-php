<?php

namespace Inbox\Tests\Models;

use Inbox\Models\Account;
use Inbox\Models\Address;
use Inbox\Models\Draft;
use Inbox\Models\File;
use Inbox\Models\Message;
use Inbox\Models\Thread;

class MessageTest extends \PHPUnit_Framework_TestCase
{
    public function testFromObject() {
        $payload = <<<JSON
{
    "id": "84umizq7c4jtrew491brpa6iu",
    "object": "message",
    "subject": "Re: Dinner on Friday?",
    "from": [
        {
            "name": "Ben Bitdiddle",
            "email": "ben.bitdiddle@example.com"
        }
    ],
    "to": [
        {
            "name": "Bill Rogers",
            "email": "wbrogers@example.com"
        }
    ],
    "cc": [
        "info@example.com",
        "support@example.com"
    ],
    "bcc": [
        {
            "name": "Administrator",
            "email": "admin@example.com"
        }
    ],
    "date": 1370084645,
    "thread": "5vryyrki4fqt7am31uso27t3f",
    "files": [
        "1g76i48k34wqbf6qgp285nw0o"
    ],
    "body": "<html><body>....</body></html>",
    "namespace": "dl93uas9mvl0jg55l7zhqr2x"
}
JSON;

        $message = Message::fromObject(json_decode($payload, true));
        $this->assertInstanceof('Inbox\Models\Account', $message->getAccount());
        $this->assertEquals('dl93uas9mvl0jg55l7zhqr2x', $message->getAccount()->getId());
        $this->assertEquals('84umizq7c4jtrew491brpa6iu', $message->getId());
        $this->assertEquals('Re: Dinner on Friday?', $message->getSubject());
        /** @todo Docs specify an array for this - can a message have multiple authors? */
        $this->assertInternalType('array', $message->getFrom());
        $this->assertCount(1, $message->getFrom());
        $this->assertEquals('ben.bitdiddle@example.com', $message->getFrom()[0]->getEmail());
        $this->assertInternalType('array', $message->getTo());
        $this->assertCount(1, $message->getTo());
        $this->assertEquals('wbrogers@example.com', $message->getTo()[0]->getEmail());
        $this->assertInternalType('array', $message->getCc());
        $this->assertCount(2, $message->getCc());
        $this->assertInstanceOf('Inbox\Models\Address', $message->getCc()[0]);
        $this->assertInternalType('array', $message->getBcc());
        $this->assertCount(1, $message->getBcc());
        $this->assertInstanceOf('Inbox\Models\Address', $message->getBcc()[0]);
        $this->assertInstanceOf('DateTime', $message->getDate());
        $this->assertEquals('2013-06-01T11:04:05+00:00', $message->getDate()->format('c'));
        $this->assertInstanceOf('Inbox\Models\Thread', $message->getThread());
        $this->assertEquals('5vryyrki4fqt7am31uso27t3f', $message->getThread()->getId());
        $this->assertInternalType('array', $message->getFiles());
        $this->assertCount(1, $message->getFiles());
        $this->assertInstanceOf('Inbox\Models\File', $message->getFiles()[0]);
        $this->assertEquals('1g76i48k34wqbf6qgp285nw0o', $message->getFiles()[0]->getId());
        $this->assertContains('....', $message->getBody());
    }

    public function testReadState()
    {
        $message = new Message(new Account('dl93uas9mvl0jg55l7zhqr2x'), '84umizq7c4jtrew491brpa6iu');
        $this->assertTrue($message->isUnread());

        $message->markRead();
        $this->assertFalse($message->isUnread());

        $message->markUnread();
        $this->assertTrue($message->isUnread());
    }

    public function testCreate()
    {
        $account = new Account('dl93uas9mvl0jg55l7zhqr2x');

        $draft = new Draft($account);
        $this->assertEquals('dl93uas9mvl0jg55l7zhqr2x', $draft->getAccount()->getId());
        $this->assertLessThanOrEqual((new \DateTime)->getTimestamp(), $draft->getDate()->getTimestamp());

        $draft->setSubject('Enquiry');
        $draft->setFrom([new Address('ross@example.com')]);
        $draft->setTo([new Address('recipient@example.com'), new Address('other@example.com')]);
        $draft->setCc([new Address('office@example.com')]);
        $draft->setBcc([new Address('boss@example.com')]);
        $draft->setDate(new \DateTime('2014-05-04 00:01:00', new \DateTimeZone('UTC')));
        $draft->setFiles([new File($account, 'file1')]);
        $draft->setThread(new Thread($account, 'thread1'));
        $draft->setBody('<marquee><blink>Hello</blink></marquee>');

        $this->assertEquals('Enquiry', $draft->getSubject());
        $this->assertInternalType('array', $draft->getFrom());
        $this->assertCount(1, $draft->getFrom());
        $this->assertEquals('ross@example.com', $draft->getFrom()[0]->getEmail());
        $this->assertInternalType('array', $draft->getTo());
        $this->assertCount(2, $draft->getTo());
        $this->assertEquals('recipient@example.com', $draft->getTo()[0]->getEmail());
        $this->assertInternalType('array', $draft->getCc());
        $this->assertCount(1, $draft->getCc());
        $this->assertEquals('office@example.com', $draft->getCc()[0]->getEmail());
        $this->assertInstanceOf('Inbox\Models\Address', $draft->getCc()[0]);
        $this->assertInternalType('array', $draft->getBcc());
        $this->assertCount(1, $draft->getBcc());
        $this->assertEquals('boss@example.com', $draft->getBcc()[0]->getEmail());
        $this->assertInstanceOf('Inbox\Models\Address', $draft->getBcc()[0]);
        $this->assertInstanceOf('DateTime', $draft->getDate());
        $this->assertEquals('2014-05-04T00:01:00+00:00', $draft->getDate()->format('c'));
        $this->assertInstanceOf('Inbox\Models\Thread', $draft->getThread());
        $this->assertEquals('thread1', $draft->getThread()->getId());
        $this->assertInternalType('array', $draft->getFiles());
        $this->assertCount(1, $draft->getFiles());
        $this->assertInstanceOf('Inbox\Models\File', $draft->getFiles()[0]);
        $this->assertEquals('file1', $draft->getFiles()[0]->getId());
        $this->assertContains('Hello', $draft->getBody());
    }
}