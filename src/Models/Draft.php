<?php

namespace Inbox\Models;

use DateTime;

/**
 * A mutable email message that has not yet been sent
 */
class Draft extends Message
{
    /**
     * @param Account $account
     * @param string|null $id
     */
    public function __construct(Account $account, $id = null)
    {
        $this->account = $account;

        if (!is_null($id)) {
            $this->id = $id;
        }

        /** @todo Is UTC preferable here or date.default_timezone? */
        $this->date = new \DateTime('now');
    }

    /**
     * @param string $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @param Address[] $from List of emails or hashes of name and email
     */
    public function setFrom(array $from)
    {
        $this->from = $from;
    }

    /**
     * @param Address[] $to List of emails or hashes of name and email
     */
    public function setTo(array $to)
    {
        $this->to = $to;
    }

    /**
     * @param Address[] $cc List of emails or hashes of name and email
     */
    public function setCc(array $cc)
    {
        $this->cc = $cc;
    }

    /**
     * @param Address[] $bcc List of emails or hashes of name and email
     */
    public function setBcc(array $bcc)
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
}