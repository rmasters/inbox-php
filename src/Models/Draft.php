<?php

namespace Inbox\Models;

use DateTime;

/**
 * A mutable email message that has not yet been sent
 */
class Draft extends Message
{
    /** @var string */
    protected $replyToThread;

    public function __construct()
    {
    }

    /**
     * @param Account $account
     */
    public function setAccount(Account $account)
    {
        $this->account = $account;
    }

    /**
     * @param string $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @param array $from List of emails or hashes of name and email
     */
    public function setFrom($from)
    {
        $this->from = $from;
    }

    /**
     * @param array $to List of emails or hashes of name and email
     */
    public function setTo($to)
    {
        $this->to = $to;
    }

    /**
     * @param array $cc List of emails or hashes of name and email
     */
    public function setCc($cc)
    {
        $this->cc = $cc;
    }

    /**
     * @param array $bcc List of emails or hashes of name and email
     */
    public function setBcc($bcc)
    {
        $this->bcc = $bcc;
    }

    /**
     * @param DateTime $date
     */
    public function setDate(DateTime $date)
    {
        $this->date = $date;
    }

    /**
     * @param File[] $files
     */
    public function setFiles(array $files)
    {
        $this->files = $files;
    }

    /**
     * @param Thread $thread
     */
    public function setThread(Thread $thread)
    {
        $this->thread = $thread;
    }

    /**
     * @param string $body HTML body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @param Thread $thread
     */
    public function setReplyToThread(Thread $thread)
    {
        $this->replyToThread = $thread;
    }
}