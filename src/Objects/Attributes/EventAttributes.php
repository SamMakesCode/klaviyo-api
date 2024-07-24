<?php

namespace SamMakesCode\KlaviyoApi\Objects\Attributes;

class EventAttributes extends BaseAttributes
{
    public function writableFields(): array
    {
        return [
            'properties',
            'time',
            'value',
            'value_currency',
        ];
    }
}
