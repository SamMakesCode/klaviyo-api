<?php

namespace SamMakesCode\Tests\Unit;

use GuzzleHttp\Exception\RequestException;
use SamMakesCode\KlaviyoApi\Objects\Event;
use SamMakesCode\KlaviyoApi\Objects\Metric;
use SamMakesCode\KlaviyoApi\Objects\Profile;

class EventsTest extends CustomTestCase
{
    public function testCanCreateEvent()
    {
        try {
            $event = $this->klaviyoApi->events()->create(
                Event::make(
                    [
                        'properties' => [
                            'custom_property' => 'Why, yes!',
                        ],
                    ],
                    Metric::make('Created Account'),
                    Profile::make([
                        'email' => 'john@example.org',
                    ]),
                ),
            );
        } catch (RequestException $requestException) {
            var_dump($requestException->getResponse()->getBody()->getContents()); exit;
        }

        // Created events don't get responses?
        $this->assertNull($event);
    }
}
