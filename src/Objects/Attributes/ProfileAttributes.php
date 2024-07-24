<?php

namespace SamMakesCode\KlaviyoApi\Objects\Attributes;

class ProfileAttributes extends BaseAttributes
{
    public function writableFields(): array
    {
        return [
            'email',
            'phone_number',
            'external_id',
            'first_name',
            'last_name',
            'organization',
            'title',
            'image',
            'location',
            'properties',
        ];
    }
}
