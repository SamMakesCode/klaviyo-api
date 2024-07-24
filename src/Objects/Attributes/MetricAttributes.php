<?php

namespace SamMakesCode\KlaviyoApi\Objects\Attributes;

class MetricAttributes extends BaseAttributes
{
    public function writableFields(): array
    {
        return [
            'name',
        ];
    }
}
