<?php

namespace Inbox\Models;

class File implements Constructable
{
    /** @var string */
    protected $id;
    /** @var Account */
    protected $account;
    /** @var Message */
    protected $message;
    /** @var string */
    protected $filename;
    /** @var int */
    protected $size;
    /** @var string */
    protected $contentType;
    /** @var bool */
    protected $embedded;

    /**
     * @param Account $account
     * @param string $id
     */
    public function __construct(Account $account, $id)
    {
        $this->id = $id;
        $this->account = $account;
    }

    public static function fromObject($data)
    {
        $file = new File(new Account($data['namespace']), $data['id']);
        $file->message = new Message($file->getAccount(), $data['message']);
        $file->filename = $data['filename'];
        $file->size = $data['size'];
        $file->contentType = $data['content-type'];
        $file->embedded = $data['is_embedded'];
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Account
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * @param Account $account
     */
    public function setAccount($account)
    {
        $this->account = $account;
    }

    /**
     * @return Message
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param Message $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @param string $filename
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param int $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * @return string
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * @param string $contentType
     */
    public function setContentType($contentType)
    {
        $this->contentType = $contentType;
    }

    /**
     * @return boolean
     */
    public function isEmbedded()
    {
        return $this->embedded;
    }

    /**
     * @param boolean $isEmbedded
     */
    public function setEmbedded($isEmbedded)
    {
        $this->embedded = (bool) $isEmbedded;
    }
}