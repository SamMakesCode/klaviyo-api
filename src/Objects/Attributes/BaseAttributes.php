<?php

namespace SamMakesCode\KlaviyoApi\Objects\Attributes;

abstract class BaseAttributes implements Attributes
{
    public function __construct(
        public readonly array $attributes,
    ) {}

    public function export(bool $forWriting = false): array
    {
        if (!$forWriting) {
            return $this->attributes;
        }

        $toReturn = [];
        foreach ($this->attributes as $name => $object) {
            if (in_array($name, $this->writableFields())) {
                $toReturn[$name] = $object;
            }
        }
        return $toReturn;
    }

    public function get(string $name)
    {
        return $this->attributes[$name];
    }
}
