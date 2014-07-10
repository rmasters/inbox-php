<?php

namespace Inbox\Models;

class Contact extends Address
{
    /** @var string */
    protected $id;
    /** @var Account */
    protected $account;

    /**
     * @param Account|null $account
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
     * @return Contact
     */
    public static function fromObject($data)
    {
        $contact = new Contact(new Account($data['namespace']), $data['id']);
        $contact->setEmail($data['email']);
        $contact->setName($data['name']);

        return $contact;
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
}