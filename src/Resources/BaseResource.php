<?php

namespace SamMakesCode\KlaviyoApi\Resources;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

abstract class BaseResource
{
    public function __construct(
        protected readonly Client $client,
        protected string $objectName,
        protected string $prefix,
    ) {
        if ($this->prefix === null) {
            throw new \ValueError('Prefix on ' . static::class . ' cannot be null.');
        }
    }

    public function list(): array
    {
        return $this->populateObjects(
            $this->unpackResponse(
                $this->client->get($this->prefix),
            ),
        );
    }

    public function get(string $id)
    {
        return $this->populateObject(
            $this->unpackResponse(
                $this->client->get($this->prefix . '/' . $id),
            ),
        );
    }

    protected function unpackResponse(ResponseInterface $response): ?array
    {
        $rawBody = $response->getBody()->getContents();

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

    protected function populateObject(array $objectData)
    {
        return new ($this->objectName)(
            $objectData['id'],
            $objectData['attributes'],
        );
    }
}
