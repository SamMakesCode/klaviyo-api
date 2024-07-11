<?php

namespace SamMakesCode\KlaviyoApi\Objects;

use SamMakesCode\KlaviyoApi\Objects\Attributes\EventAttributes;

class Event extends BaseObject
{
    public function __construct(
        ?string $id,
        array $attributes
    ) {
        parent::__construct(
            EventAttributes::class,
            $id,
            $attributes,
            'event',
        );
    }
}
