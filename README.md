Klaviyo API
---

Klaviyo's PHP library seems like it was assembled on a computer without a monitor, doesn't it? Here, I've created a rudimentary layer on top of Guzzle to provide a more sensible experience.

# Requirements

- PHP 8.2 or later
- Composer

# Installation

```
composer require sammakescode/klaviyo-api
```

# Example

This section will give you an example. Check out the [Wiki]() for more detailed information.

## Sending an Event

We can send an event for an anonymous user like this.

```php
    use \SamMakesCode\KlaviyoApi\KlaviyoApi;
    use \SamMakesCode\KlaviyoApi\Objects\Metric;
    use \SamMakesCode\KlaviyoApi\Objects\Profile;

    $client = new KlaviyoApi('your-api-key');
    $client->events()->create(Event::make(
        [
            'properties' => [
                'custom_property' => 'Why, yes!',
            ],
        ],
        Metric::make('Created Account'),
        Profile::make([
            'email' => 'john@example.org',
        ])
    ));
```

# Laravel

The library works perfectly well with Laravel, but you'll need to set up a service provider for it.

```php
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use SamMakescode\KlaviyoApi\KlaviyoApi;

class KlaviyoServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(KlaviyoApi::class, function () {
            return new KlaviyoApi(
                env('KLAVIYO_API_KEY'),
            );
        });
    }
}
```

Don't for get to add your API key to your `.env` file.

# Contributions

Contribution and issues are welcome.
