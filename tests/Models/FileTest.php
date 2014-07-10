<?php

namespace Inbox\Tests\Models;

use Inbox\Models\Account;
use Inbox\Models\File;
use Inbox\Models\Message;

class FileTest extends \PHPUnit_Framework_TestCase
{
    public function testFromObject()
    {
        $payload = <<<JSON
{
    "id": "conefgqnnsvqlj64iu0lvsb7g",
    "object": "file",
    "namespace": "awa6ltos76vz5hvphkp8k17nt",
    "filename": "House-Blueprints.zip",
    "size": 3145728,
    "content-type": "application/zip",
    "message": "152ev3uktfrtk3y2subs4i9mn",
    "is_embedded": false
}
JSON;

        $file = File::fromObject(json_decode($payload, true));
        $this->assertInstanceOf('Inbox\Models\Account', $file->getAccount());
        $this->assertEquals('awa6ltos76vz5hvphkp8k17nt', $file->getAccount()->getId());
        $this->assertEquals('conefgqnnsvqlj64iu0lvsb7g', $file->getId());
        $this->assertInstanceOf('Inbox\Models\Message', $file->getMessage());
        $this->assertEquals('152ev3uktfrtk3y2subs4i9mn', $file->getMessage()->getId());
        $this->assertEquals('House-Blueprints.zip', $file->getFilename());
        $this->assertEquals(3145728, $file->getSize());
        $this->assertEquals('application/zip', $file->getContentType());
        $this->assertFalse($file->isEmbedded());
    }

    public function testCreate()
    {
        $account = new Account('awa6ltos76vz5hvphkp8k17nt');
        $message = new Message($account, '152ev3uktfrtk3y2subs4i9mn');

        $file = new File($account);
        $file->setMessage($message);
        $file->setFilename('House-Blueprints.zip');
        $file->setSize(3145728);
        $file->setContentType('application/zip');
        $file->setEmbedded(false);

        $this->assertInstanceOf('Inbox\Models\Message', $file->getMessage());
        $this->assertEquals('152ev3uktfrtk3y2subs4i9mn', $file->getMessage()->getId());
        $this->assertEquals('House-Blueprints.zip', $file->getFilename());
        $this->assertEquals(3145728, $file->getSize());
        $this->assertEquals('application/zip', $file->getContentType());
        $this->assertFalse($file->isEmbedded());
    }
}