<?php

namespace SamMakesCode\KlaviyoApi\Resources;

use GuzzleHttp\Client;
use SamMakesCode\KlaviyoApi\Objects\Event;

/**
 * @method Event get(string $id)
 * @method Event[] list()
 */
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
