<?php

namespace SamMakesCode\KlaviyoApi\Objects;

use SamMakesCode\KlaviyoApi\Objects\Attributes\MetricAttributes;

class Metric extends BaseObject
{
    public function __construct(
        ?string $id,
        array $attributes
    ) {
        parent::__construct(
            MetricAttributes::class,
            $id,
            $attributes,
            'metric',
        );
    }

    public static function custom(string $name): static
    {
        return static::empty([
            'name' => $name,
        ]);
    }
}
