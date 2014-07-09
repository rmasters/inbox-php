<?php

namespace Inbox\Models;

use DateTime;

/**
 * An immutable, received email message
 */
class Message implements Constructable
{
    use LazyLoader;

    /** @var string */
    protected $id;
    /** @var Account */
    protected $account;
    /** @var string */
    protected $subject;
    /** @var Address[] */
    protected $from;
    /** @var Address[] */
    protected $to;
    /** @var Address[] */
    protected $cc;
    /** @var Address[] */
    protected $bcc;
    /** @var DateTime */
    protected $date;
    /** @var Thread */
    protected $thread;
    /** @var File[] */
    protected $files;
    /** @var string */
    protected $body;
    /** @var boolean */
    protected $unread;

    /**
     * @param Account $account
     * @param string $id
     */
    public function __construct(Account $account, $id)
    {
        $this->id = $id;
        $this->account = $account;
    }

    /**
     * @param array $data
     * @return Message
     */
    public static function fromObject($data)
    {
        $message = new self(new Account($data['namespace']), $data['id']);
        $message->subject = $data['subject'];
        $message->from = array_map(function ($from) {
            return Address::fromObject($from);
        }, $data['from']);
        $message->to = array_map(function ($to) {
            return Address::fromObject($to);
        }, $data['to']);
        $message->cc = array_map(function ($cc) {
            return Address::fromObject($cc);
        }, $data['cc']);
        $message->bcc = array_map(function ($bcc) {
            return Address::fromObject($bcc);
        }, $data['bcc']);
        $message->date = new \DateTime('@' . $data['date']);
        $message->thread = new Thread($message->getAccount(), $data['thread']);
        $message->files = array_map(function($file) use ($message) {
            return new File($message->getAccount(), $file);
        }, $data['files']);
        $message->body = $data['body'];

        return $message;
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
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @return Address[]
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @return Address[]
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @return Address[]
     */
    public function getCc()
    {
        return $this->cc;
    }

    /**
     * @return Address[]
     */
    public function getBcc()
    {
        return $this->bcc;
    }

    /**
     * @return DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return Thread
     */
    public function getThread()
    {
        return $this->thread;
    }

    /**
     * @return File[]
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return bool
     */
    public function isUnread()
    {
        return $this->unread;
    }

    /**
     * Mark message as unread
     */
    public function markUnread()
    {
        $this->unread = true;
    }

    /**
     * Mark message as read
     */
    public function markRead()
    {
        $this->unread = false;
    }
}