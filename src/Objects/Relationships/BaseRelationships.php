<?php

namespace SamMakesCode\KlaviyoApi\Objects\Relationships;

abstract class BaseRelationships implements Relationships
{
    public function __construct(
        private readonly array $relationships,
    ) {}

    public function export(): array
    {
        return $this->relationships;
    }
}
