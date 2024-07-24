<?php

namespace SamMakesCode\KlaviyoApi\Objects;

use SamMakesCode\KlaviyoApi\Objects\Attributes\BaseAttributes;
use SamMakesCode\KlaviyoApi\Objects\Relationships\BaseRelationships;

interface KlaviyoObject
{
    public function getId(): string;

    public function setId(string $id): void;

    public function getAttributes(): BaseAttributes;

    public function setAttributes(BaseAttributes $attributes): void;

    public function getRelationships(): BaseRelationships;

    public function setRelationships(BaseRelationships $relationships): void;

    public function getAttributesClass() : string;

    public function getRelationshipsClass() : string;

    public function export(): array;
}
