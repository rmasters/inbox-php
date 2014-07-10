# Inbox

A PHP wrapper around the [Inbox][inboxapp] API.

[![Build Status](https://img.shields.io/travis/rmasters/inbox-php.svg)](https://travis-ci.org/rmasters/inbox-php)
[![Coverage Status](https://img.shields.io/coveralls/rmasters/inbox-php.svg)](https://coveralls.io/r/rmasters/inbox-php)
[![Latest Stable Version](https://img.shields.io/packagist/v/rmasters/inbox.svg)](https://packagist.org/packages/rmasters/inbox)
[![License](https://img.shields.io/packagist/l/rmasters/inbox.svg)](https://packagist.org/packages/rmasters/inbox)



## Installation

This Composer package is named `rmasters/inbox` on Packagist. You can install it:

*   using the Composer tool: `composer require "rmasters/inbox:~1"`,
*   or by adding to your composer.json's `require` section: `"rmasters/inbox": "~1"`.

This package is early on in development - expect the API to change a little until a v1.0 stable release.

## Requirements

*   An Inbox server ([open-source][inboxrepo] or [hosted][inboxapp]),
*   PHP 5.4+.
*   Released under an [MIT License](LICENSE).

## Usage

Take a look over the [API documentation][apidocs] first, to familiarise yourself with the Inbox concepts.

```php
// Specify a custom server, or use inboxapp.com by default
$inbox = new Inbox\Inbox('http://127.0.0.1:5555/');

// Get namespace (email account) information
$accountId = 'awa6ltos76vz5hvphkp8k17nt';
$account = $inbox->account($accountId); // => Account

// Get messages
$inbox->messages($account)->all(); // => Message[]
$inbox->messages($accountId)->get($messageId); // => Message
```

## Orientation

A few notes and things to watch out for:

*   Given that `namespace` is a reserved word in PHP, Namespaces are referred to as Accounts.

[inboxapp]: https://www.inboxapp.com/
[apidocs]: https://www.inboxapp.com/docs/api#overview
[inboxrepo]: https://github.com/inboxapp/inbox#readme
