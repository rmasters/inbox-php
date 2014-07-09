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
    /** @var string */
    protected $subject;
    /** @var array List of emails or hashes of name and email */
    protected $from;
    /** @var array List of emails or hashes of name and email */
    protected $to;
    /** @var array List of emails or hashes of name and email */
    protected $cc;
    /** @var array List of emails or hashes of name and email */
    protected $bcc;
    /** @var DateTime */
    protected $date;
    /** @var Thread */
    protected $thread;
    /** @var File[] */
    protected $files;
    /** @var string */
    protected $body;

    /**
     * @param string $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Construct a Message from a JSON payload
     * @param array $data
     * @return Message
     */
    public static function fromObject(array $data)
    {
        $message = new self($data['id']);
        $message->subject = $data['subject'];
        $message->from = $data['from'];
        $message->to = $data['to'];
        $message->cc = $data['cc'];
        $message->bcc = $data['bcc'];
        $message->date = new \DateTime('@' . $data['date']);
        $message->thread = new Thread($data['thread']);
        $message->files = array_map(function($file) {
            return new File($file);
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
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @return array
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @return array
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @return array
     */
    public function getCc()
    {
        return $this->cc;
    }

    /**
     * @return array
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
}