<?php

namespace SamMakesCode\KlaviyoApi\Resources;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use SamMakesCode\KlaviyoApi\Objects\BaseObject;

abstract class WritableResource extends BaseResource
{
    public function __construct(
        Client $client,
        string $objectName,
        string $prefix,
        protected string $type,
    ) {
        parent::__construct($client, $objectName, $prefix);
    }

    public function create(array $attributes)
    {
        /** @var BaseObject $object */
        $object = $this->objectName;

        $event = $object::empty($attributes);

        $body = json_encode($event->toArray());

        $objectData = $this->unpackResponse(
            $this->client->post($this->prefix, [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'body' => $body,
            ]),
        );

        if ($objectData === null) {
            return null;
        }

        return $this->populateObject(
            $objectData,
        );
    }

    public function update(string $id, array $attributes)
    {
        /** @var BaseObject $object */
        $object = $this->objectName;

        $event = new $object($id, $attributes);

        $body = json_encode($event->toArray());

        $objectData = $this->unpackResponse(
            $this->client->patch($this->prefix . '/' . $id, [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'body' => $body,
            ])
        );

        if ($objectData === null) {
            return null;
        }

        return $this->populateObject(
            $objectData,
        );
    }

    public function createOrUpdate(?string $id, array $attributes)
    {
        /** @var BaseObject $object */
        $object = $this->objectName;

        if ($id === null) {
            $event = $object::empty($attributes);
        } else {
            $event = new $object($id, $attributes);
        }

        $body = json_encode($event->toArray());

        $objectData = $this->unpackResponse(
            $this->client->post($this->prefix . '/' . $id, [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'body' => $body,
            ])
        );

        if ($objectData === null) {
            return null;
        }

        return $this->populateObject(
            $objectData,
        );
    }
}
