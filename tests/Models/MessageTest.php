<?php

namespace Inbox\Tests\Models;

use Inbox\Models\Message;

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
            "email": "ben.bitdiddle@gmail.com"
        }
    ],
    "to": [
        {
            "name": "Bill Rogers",
            "email": "wbrogers@mit.edu"
        }
    ],
    "cc": [],
    "bcc": [],
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

        $this->assertEquals('84umizq7c4jtrew491brpa6iu', $message->getId());
        $this->assertEquals('Re: Dinner on Friday?', $message->getSubject());
        /** @todo Docs specify an array for this - can a message have multiple authors? */
        $this->assertInternalType('array', $message->getFrom());
        $this->assertCount(1, $message->getFrom());
        $this->assertEquals('ben.bitdiddle@gmail.com', $message->getFrom()[0]->getEmail());
        $this->assertInternalType('array', $message->getTo());
        $this->assertCount(1, $message->getTo());
        $this->assertEquals('wbrogers@mit.edu', $message->getTo()[0]->getEmail());
        $this->assertInternalType('array', $message->getCc());
        $this->assertInternalType('array', $message->getBcc());
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
}