<?php

namespace Inbox\Models;

use DateTime;

class Thread implements Constructable
{
    use LazyLoader;

    /** @var string */
    protected $id;
    /** @var Account */
    protected $account;
    /** @var string */
    protected $subject;
    /** @var DateTime */
    protected $lastMessage;
    /** @var array List of emails or hashes of email and name */
    protected $participants;
    /** @var string */
    protected $snippet;
    /** @var Tag[] */
    protected $tags;
    /** @var Message[] */
    protected $messages;
    /** @var Draft[] */
    protected $drafts;

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
     * @return Thread
     */
    public static function fromObject($data)
    {
        $thread = new self(new Account($data['namespace']), $data['id']);
        $thread->subject = $data['subject'];
        $thread->lastMessage = new DateTime('@' . $data['last_message_timestamp']);
        $thread->participants = array_map(function ($participant) {
            return Address::fromObject($participant);
        }, $data['participants']);
        $thread->snippet = $data['snippet'];
        $thread->tags = array_map(function ($tag) use ($thread) {
            return Tag::fromObject(array_merge($tag, ['account' => $thread->getAccount()->getId()]));
        }, $data['tags']);
        $thread->messages = array_map(function ($id) use ($thread) {
            return new Message($thread->getAccount(), $id);
        }, $data['messages']);
        $thread->drafts = array_map(function ($id) use ($thread) {
            return new Draft($id, $thread->getAccount());
        }, $data['drafts']);

        return $thread;
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
     * @return DateTime
     */
    public function getLastMessage()
    {
        return $this->lastMessage;
    }

    /**
     * @return array
     */
    public function getParticipants()
    {
        return $this->participants;
    }

    /**
     * @return string
     */
    public function getSnippet()
    {
        return $this->snippet;
    }

    /**
     * @return Tag[]
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @return Message[]
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * @return Draft[]
     */
    public function getDrafts()
    {
        return $this->drafts;
    }


}