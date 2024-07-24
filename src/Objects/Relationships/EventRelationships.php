<?php

namespace SamMakesCode\KlaviyoApi\Objects\Relationships;

class EventRelationships extends BaseRelationships
{
    public static function validRelationships(): array
    {
        return [
            'profile',
            'metric',
        ];
    }
}
