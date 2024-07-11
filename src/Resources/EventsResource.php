<?php

namespace SamMakesCode\KlaviyoApi\Resources;

use GuzzleHttp\Client;
use SamMakesCode\KlaviyoApi\Objects\Event;

class EventsResource extends WritableResource
{
    public function __construct(Client $client)
    {
        parent::__construct(
            $client,
            Event::class,
            'events',
            'event',
        );
    }
}
