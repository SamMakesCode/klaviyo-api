<?php

namespace SamMakesCode\KlaviyoApi\Resources;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\ResponseInterface;
use SamMakesCode\KlaviyoApi\Exceptions\ObjectNotFound;
use SamMakesCode\KlaviyoApi\Objects\BaseObject;
use SamMakesCode\KlaviyoApi\Objects\Relationships\BaseRelationships;

abstract class BaseResource
{
    public function __construct(
        protected readonly Client $client,
        protected string $objectName,
        protected string $prefix,
    ) {}

    public function list(): array
    {
        $response = $this->client->get($this->prefix);

        return $this->populateObjects(
            $this->unpackResponse(
                $response,
            ),
        );
    }

    /**
     * @throws ObjectNotFound
     */
    public function get(string $id)
    {
        try {
            $response = $this->client->get($this->prefix . '/' . $id);
        } catch (ClientException $clientException) {
            if ($clientException->getResponse()->getStatusCode() === 404) {
                throw new ObjectNotFound($this->prefix, $id, $clientException);
            }

            throw $clientException;
        }

        return $this->populateObject(
            $this->unpackResponse(
                $response,
            ),
        );
    }

    protected function unpackResponse(ResponseInterface $response): ?array
    {
        $rawBody = $response->getBody()->getContents();

        if (empty($rawBody)) {
            return null;
        }

        $body = json_decode($rawBody, true);

        $data = $body['data'];

        return $data;
    }

    protected function populateObjects(array $objectsData): array
    {
        $objects = [];

        foreach ($objectsData as $data) {
            $objects[] = $this->populateObject($data);
        }

        return $objects;
    }

    protected function populateObject(array $objectData): BaseObject
    {
        /** @var BaseObject $object */
        $object = new ($this->objectName)();

        $object->setId($objectData['id']);
        $attributes = new ($object->getAttributesClass())($objectData['attributes']);

        /** @var BaseRelationships $relationshipsClass */
        $relationshipsClass = $object->getRelationshipsClass();
        $relationshipsData = [];
        foreach ($objectData['relationships'] as $name => $value) {
            if (in_array($name, $relationshipsClass::validRelationships())) {
                $relationshipsData[$name] = $value;
            }
        }

        $relationships = new $relationshipsClass($relationshipsData);
        $object->setAttributes($attributes);
        $object->setRelationships($relationships);

        return $object;
    }
}
