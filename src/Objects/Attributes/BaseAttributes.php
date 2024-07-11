<?php

namespace SamMakesCode\KlaviyoApi\Objects\Attributes;

abstract class BaseAttributes
{
    public function __construct(
        public readonly array $attributes,
    ) {}

    public function __get(string $name)
    {
        if (!isset($this->attributes[$name])) {
            throw new \InvalidArgumentException('No property "' .  $name . '" on ' . get_called_class());
        }

        return $this->attributes[$name];
    }
}
