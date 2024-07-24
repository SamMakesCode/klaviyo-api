<?php

namespace SamMakesCode\KlaviyoApi\Objects;

use SamMakesCode\KlaviyoApi\Objects\Attributes\MetricAttributes;
use SamMakesCode\KlaviyoApi\Objects\Relationships\MetricRelationships;

class Metric extends BaseObject
{
    public function __construct()
    {
        parent::__construct('metric');
    }

    public function getAttributesClass(): string
    {
        return MetricAttributes::class;
    }

    public function getRelationshipsClass(): string
    {
        return MetricRelationships::class;
    }

    public static function make(string $name): static
    {
        $metric = new static;
        $metric->setAttributes([
            'name' => $name,
        ]);
        return $metric;
    }
}