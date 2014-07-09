<?php

namespace Inbox\Tests\Endpoints;

class AccountsTest extends EndpointBase
{
    public function testGetAccounts()
    {
        $accounts = $this->getInbox()->accounts()->all();

        $this->assertCount(1, $accounts);
        $this->assertInstanceOf('Inbox\Models\Account', $accounts[0]);
    }

    public function testGetAccount()
    {
        $account = $this->getInbox()->accounts()->get($this->getAccount());

        $this->assertInstanceOf('Inbox\Models\Account', $account);
        $this->assertEquals($this->getAccount(), $account->getId());
    }
}