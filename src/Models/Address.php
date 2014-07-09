<?php

namespace Inbox\Models;

class Address implements Constructable
{
    /** @var string|null */
    protected $name;
    /** @var string */
    protected $email;

    /**
     * @param array $data
     * @return Address
     */
    public static function fromObject($data)
    {
        $address = new Address();
        if (is_array($data)) {
            $address->setEmail($data['email']);
            $address->setName($data['name']);
        } else {
            $address->setEmail($data);
        }

        return $address;
    }

    /**
     * @return string|null
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

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }
}