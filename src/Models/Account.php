<?php

namespace Inbox\Models;

/**
 * An Inbox Namespace - an email account
 */
class Account implements Constructable
{
    use LazyLoader;

    /** @var string */
    protected $id;
    /** @var string */
    protected $account;
    /** @var string */
    protected $emailAddress;
    /** @var string */
    protected $provider;

    /**
     * @param string $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @param array $data
     * @return Account
     */
    public static function fromObject($data)
    {
        $account = new self($data['id']);
        $account->account = $data['account'];
        $account->emailAddress = $data['email_address'];
        $account->provider = $data['provider'];

        return $account;
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
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * @return string
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    /**
     * @return string
     */
    public function getProvider()
    {
        return $this->provider;
    }
}
