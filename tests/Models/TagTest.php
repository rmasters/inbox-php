<?php

namespace Inbox\Tests\Models;

use Inbox\Models\Account;
use Inbox\Models\Tag;

class TagTest extends \PHPUnit_Framework_TestCase
{
    public function testTagFromObject()
    {
        $payload = <<<JSON
{
    "id": "8nel37ax25gg2nh4kumfj1vue",
    "name": "gmail-flat viewing",
    "namespace": "dl94uah9mve0j055l7zuokr2x",
    "object": "tag"
}
JSON;

        $tag = Tag::fromObject(json_decode($payload, true));
        $this->assertInstanceOf('Inbox\Models\Tag', $tag);
        $this->assertEquals('8nel37ax25gg2nh4kumfj1vue', $tag->getId());
        $this->assertInstanceOf('Inbox\Models\Account', $tag->getAccount());
        $this->assertEquals('dl94uah9mve0j055l7zuokr2x', $tag->getAccount()->getId());
        $this->assertEquals('gmail-flat viewing', $tag->getName());
    }

    public function testCreate()
    {
        $account = new Account('dl94uah9mve0j055l7zuokr2x');
        $tag = new Tag($account);
        $tag->setName('secret-project');

        $this->assertInstanceOf('Inbox\Models\Account', $tag->getAccount());
        $this->assertEquals('dl94uah9mve0j055l7zuokr2x', $tag->getAccount()->getId());
        $this->assertEquals('secret-project', $tag->getName());
    }
}