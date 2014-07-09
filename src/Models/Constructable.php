<?php

namespace Inbox\Models;

interface Constructable
{
    public static function fromObject(array $data);
}