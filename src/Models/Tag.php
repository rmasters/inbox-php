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
     * @param Account|null $account
     * @param string|null $id
     */
    public function __construct(Account $account = null, $id = null)
    {
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
     * @param Account $account
     */
    public function setAccount(Account $account)
    {
        $this->account = $account;
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