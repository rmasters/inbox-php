<?php

namespace Inbox\Models;

interface Constructable
{
    public static function fromObject($data);
}