<?php

namespace Inbox\Models;

class Address implements Constructable
{
    /** @var string|null */
    protected $name;
    /** @var string */
    protected $email;

    /**
     * @param string|null $email
     * @param string|null $name
     */
    public function __construct($email = null, $name = null)
    {
        $this->email = $email;
        $this->name = $name;
    }

    /**
     * @param array|string $data
     * @return Address
     */
    public static function fromObject($data)
    {
        $address = new Address();
        if (is_array($data)) {
            $address->email = $data['email'];
            $address->name = $data['name'];
        } else {
            $address->email = $data;
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