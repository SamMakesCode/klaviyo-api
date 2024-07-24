<?php

namespace SamMakesCode\KlaviyoApi\Objects;

use SamMakesCode\KlaviyoApi\Objects\Attributes\EventAttributes;
use SamMakesCode\KlaviyoApi\Objects\Relationships\EventRelationships;

class Event extends BaseObject
{
    public function __construct(
//        EventAttributes|array $attributes,
//        Metric $metric,
//        Profile $profile,
    ) {
        parent::__construct('event');
//
//        if (is_array($attributes)) {
//            $attributes = new EventAttributes($attributes);
//        }
//
//        $this->setAttributes($attributes);
//        $relationships = new EventRelationships([
//            $metric->type => $metric,
//            $profile->type => $profile,
//        ]);
//
//        $this->setRelationships($relationships);
    }

    public function getAttributesClass(): string
    {
        return EventAttributes::class;
    }

    public function getRelationshipsClass(): string
    {
        return EventRelationships::class;
    }

    public static function make(
        EventAttributes|array $attributes,
        Metric $metric,
        Profile $profile,
    ) {
        $event = new static;
        $event->setAttributes($attributes);
        $event->setRelationships([
            'metric' => $metric,
            'profile' => $profile,
        ]);
        return $event;
    }
}
