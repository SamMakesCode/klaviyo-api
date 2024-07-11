<?php

namespace SamMakesCode\Tests\Unit;

use SamMakesCode\KlaviyoApi\Objects\Metric;
use SamMakesCode\KlaviyoApi\Objects\Profile;

class EventsTest extends CustomTestCase
{
    public function testCanCreateEvent()
    {
        $event = $this->klaviyoApi->events()->create([
            'properties' => [
                'custom_property' => 'Why, yes!',
            ],
            'metric' => Metric::custom('Created Account')->toArray(),
            'profile' => Profile::empty(['email' => 'john@example.org'])->toArray(),
        ]);

        // Created events don't get responses?
        $this->assertNull($event);
    }
}
