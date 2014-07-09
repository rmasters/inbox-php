<?php

namespace Inbox\Tests\Models;

use Inbox\Models\Account;

class AccountTest extends \PHPUnit_Framework_TestCase
{
    public function testAccountFromObject()
    {
        $payload = <<<JSON
{
    "account": "b83ca5edlq6dwvoi7hn6gfvsm",
    "email_address": "ross@example.com",
    "id": "dl93uas9mvl0jg55l7zhqr2x",
    "namespace": "dl93uas9mvl0jg55l7zhqr2x",
    "object": "namepace",
    "provider": "gmail"
}
JSON;

        $account = Account::fromObject(json_decode($payload, true));
        $this->assertInstanceOf('Inbox\Models\Account', $account);
        $this->assertEquals('dl93uas9mvl0jg55l7zhqr2x', $account->getId());
        $this->assertEquals('b83ca5edlq6dwvoi7hn6gfvsm', $account->getAccount());
        $this->assertEquals('ross@example.com', $account->getEmailAddress());
        $this->assertEquals('gmail', $account->getProvider());
    }
}