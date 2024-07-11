<?php

namespace SamMakesCode\KlaviyoApi\Objects;

use SamMakesCode\KlaviyoApi\Objects\Attributes\BaseAttributes;

abstract class BaseObject
{
    public BaseAttributes $attributes;

    public function __construct(
        public string $attributesClass,
        public readonly ?string $id,
        array $attributes,
        public readonly string $type,
    ) {
        $this->populateAttributes($attributes);
    }

    protected function populateAttributes(array $attributes): void
    {
        $this->attributes = new ($this->attributesClass)(
            $attributes,
        );
    }

    public function toArray(): array
    {
        $array = [];

        if ($this->id !== null) {
            $array['id'] = $this->id;
        }

        $array['type'] = $this->type;
        $array['attributes'] = $this->attributes->attributes;

        return [
            'data' => $array,
        ];
    }

    public static function empty(array $attributes): static
    {
        return new static(
            null,
            $attributes,
        );
    }
}
