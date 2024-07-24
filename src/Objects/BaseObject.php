<?php

namespace SamMakesCode\KlaviyoApi\Objects;

use SamMakesCode\KlaviyoApi\Objects\Attributes\BaseAttributes;
use SamMakesCode\KlaviyoApi\Objects\Relationships\BaseRelationships;

abstract class BaseObject implements KlaviyoObject
{
    private string $id;
    private BaseAttributes $attributes;
    private BaseRelationships $relationships;

    public function __construct(
        public readonly string $type,
    ) {}

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getAttributes(): BaseAttributes
    {
        return $this->attributes;
    }

    public function setAttributes(array|BaseAttributes $attributes): void
    {
        if (is_array($attributes)) {
            $attributes = new ($this->getAttributesClass())($attributes);
        }

        $this->attributes = $attributes;
    }

    public function getRelationships(): BaseRelationships
    {
        return $this->relationships;
    }

    public function setRelationships(array|BaseRelationships $relationships): void
    {
        if (is_array($relationships)) {
            $relationships = new ($this->getRelationshipsClass())($relationships);
        }

        $this->relationships = $relationships;
    }

    public function export(bool $forWriting = false): array
    {
        $toExport = [
            'data' => [
                'type' => $this->type,
            ],
        ];

        if (isset($this->attributes)) {
            $toExport['data']['attributes'] = $this->getAttributes()->export($forWriting);
        }

        if (isset($this->relationships)) {
            if ($forWriting) {
                foreach ($this->getRelationships()->export() as $name => $object) {
                    $toExport['data']['attributes'][$name] = $object->export($forWriting);
                }
            } else {
                foreach ($this->getRelationships()->export() as $name => $object) {
                    $toExport['data']['relationships'][$name] = $object->export($forWriting);
                }
            }
        }

        if (isset($this->id)) {
            $toExport['data']['id'] = $this->id;
        }

        return $toExport;
    }
}
