<?php

namespace Inbox\Tests\Models;

use Inbox\Models\Address;

class AddressTest extends \PHPUnit_Framework_TestCase
{
    public function testEmail()
    {
        $addr = Address::fromObject("ross@example.com");
        $this->assertEquals("ross@example.com", $addr->getEmail());
        $this->assertNull($addr->getName());
    }

    public function testHash()
    {
        $payload = <<<JSON
{
    "name": "Ross",
    "email": "ross@example.com"
}
JSON;

        $addr = Address::fromObject(json_decode($payload, true));
        $this->assertEquals("ross@example.com", $addr->getEmail());
        $this->assertEquals("Ross", $addr->getName());
    }

    public function testCreate()
    {
        $addr = new Address();
        $addr->setEmail('ross@example.com');
        $addr->setName('Ross');

        $this->assertEquals("ross@example.com", $addr->getEmail());
        $this->assertEquals("Ross", $addr->getName());
    }
}