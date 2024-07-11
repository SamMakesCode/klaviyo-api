<?php

namespace SamMakesCode\KlaviyoApi\Objects;

use SamMakesCode\KlaviyoApi\Objects\Attributes\ProfileAttributes;

class Profile extends BaseObject
{
    public function __construct(
        ?string $id,
        array $attributes
    ) {
        parent::__construct(
            ProfileAttributes::class,
            $id,
            $attributes,
            'profile',
        );
    }
}
