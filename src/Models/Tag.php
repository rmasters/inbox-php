<?php

namespace Inbox\Models;

class Tag implements Constructable
{
    /** @var string */
    protected $id;
    /** @var Account */
    protected $account;
    /** @var string */
    protected $name;

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
    }

    /**
     * @param array $data
     * @return Tag
     */
    public static function fromObject($data)
    {
        $tag = new self(new Account($data['namespace']), $data['id']);
        $tag->name = $data['name'];

        return $tag;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}