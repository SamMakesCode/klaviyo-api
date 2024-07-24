<?php

namespace SamMakesCode\KlaviyoApi\Objects;

use SamMakesCode\KlaviyoApi\Objects\Attributes\ProfileAttributes;
use SamMakesCode\KlaviyoApi\Objects\Relationships\ProfileRelationships;

class Profile extends BaseObject
{
    public function __construct()
    {
        parent::__construct('profile');
    }

    public function getAttributesClass(): string
    {
        return ProfileAttributes::class;
    }

    public function getRelationshipsClass(): string
    {
        return ProfileRelationships::class;
    }

    public static function make(array $attributes): static
    {
        $metric = new static();
        $metric->setAttributes($attributes);
        return $metric;
    }
}
