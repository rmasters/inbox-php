<?php

namespace Inbox\Tests\Models;

use Inbox\Models\Account;
use Inbox\Models\Contact;

class ContactTest extends \PHPUnit_Framework_TestCase
{
    public function testFromObject()
    {
        $payload = <<<JSON
[
    {
        "email": null,
        "id": "6cx7r3bgyedqmwlevizy8eylx",
        "name": "John Smith",
        "namespace": "dl94uah94ve0j055l7zuokr2x",
        "object": "contact"
    },
    {
        "email": "info@example.com",
        "id": "2tbvexciy1wn0sl8259e70yj6",
        "name": "Info",
        "namespace": "dl94uah94ve0j055l7zuokr2x",
        "object": "contact"
    }
]
JSON;

        $addresses = json_decode($payload, true);
        $this->assertInternalType('array', $addresses);
        $this->assertCount(2, $addresses);

        $addr1 = Contact::fromObject($addresses[0]);
        $this->assertEquals('6cx7r3bgyedqmwlevizy8eylx', $addr1->getId());
        $this->assertInstanceOf('Inbox\Models\Account', $addr1->getAccount());
        $this->assertEquals('dl94uah94ve0j055l7zuokr2x', $addr1->getAccount()->getId());
        $this->assertNull($addr1->getEmail());
        $this->assertEquals("John Smith", $addr1->getName());

        $addr2 = Contact::fromObject($addresses[1]);
        $this->assertEquals('2tbvexciy1wn0sl8259e70yj6', $addr2->getId());
        $this->assertEquals("info@example.com", $addr2->getEmail());
        $this->assertEquals("Info", $addr2->getName());
    }

    public function testCreate()
    {
        $account = new Account('dl94uah94ve0j055l7zuokr2x');
        $addr = new Contact($account);
        $addr->setEmail('ross@example.com');
        $addr->setName('Ross');

        $this->assertInstanceOf('Inbox\Models\Account', $addr->getAccount());
        $this->assertEquals('dl94uah94ve0j055l7zuokr2x', $addr->getAccount()->getId());
        $this->assertEquals("ross@example.com", $addr->getEmail());
        $this->assertEquals("Ross", $addr->getName());
    }
}