# copper-php

PHP bindings to the Copper REST API

## Installation

This library requires PHP 7.3 and later

The recommended way to install thinkific-php is through [Composer](https://getcomposer.org):

This library is intended to speed up development time but is not a shortcut to reading the Copper documentation. Many endpoints require specific and required fields for successful operation. Always read the documentation before using an endpoint.

```sh
composer require mckltech/copper-php
```

## Clients - API Key 

Initialize your client using your access token:

```php
use Copper\CopperClient;

$client = new CopperClient('XXXXAPIKEYXXXX', 'example@copper.com');
```

> - You can find your API Key by following the Copper API documentation: https://developer.copper.com/introduction/authentication.html
> - The email supplied must be the account email of the Copper account that generated the API key


## Support, Issues & Bugs

This library is unofficial and is not endorsed or supported by Copper.

For bugs and issues, open an issue in this repo and feel free to submit a PR. Any issues that do not contain full logs or explanations will be closed. We need you to help us help you!

## Leads

```php

/** Get Lead by ID */
$client->leads->get('1234');

/** Create A Lead */
$client->leads->create(['name' => 'Joe Blogs', 'email' => ['email' => 'lead@example.com', 'category' => 'work']]);
```

## Supported Endpoints

All endpoints follow a similar mechanism to the examples show above. Again, please ensure you read the Copper API documentation prior to use as there are numerous required fields for most POST/PUT operations.

- Accounts
- Activities
- Companies
- Custom Activites
- Custom Field Defintions
- Leads
- Opportunities
- People
- Projects
- Related Items
- Tasks

## Exceptions

Exceptions are handled by HTTPlug. Every exception thrown implements `Http\Client\Exception`. See the [http client exceptions](http://docs.php-http.org/en/latest/httplug/exceptions.html) and the [client and server errors](http://docs.php-http.org/en/latest/plugins/error.html). If you want to catch errors you can wrap your API call into a try/catch block:

```php
try {
    $users = $client->users->list();
} catch(Http\Client\Exception $e) {
    if ($e->getCode() == '404') {
        // Handle 404 error
        return;
    } else {
        throw $e;
    }
}
```

## Credit

The layout and methodology used in this library is courtesty of https://github.com/intercom/intercom-php


