<?php

namespace SamMakesCode\KlaviyoApi\Resources;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use SamMakesCode\KlaviyoApi\Exceptions\InvalidRequest;
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

    public function create(BaseObject $object)
    {
        try {
            $response = $this->client->post($this->prefix, [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'body' => json_encode($object->export(true)),
            ]);
        } catch (ClientException $clientException) {
            if ($clientException->getResponse()->getStatusCode() === 400) {
                $jsonResponse = json_decode($clientException->getResponse()->getBody()->getContents(), true);

                throw new InvalidRequest('Object creation failed because: "' . $jsonResponse['errors'][0]['detail'] . '"');
            } else {
                throw $clientException;
            }
        }

        $objectData = $this->unpackResponse($response);

        if ($objectData === null) {
            return null;
        }

        return $this->populateObject(
            $objectData,
        );
    }

    public function update(BaseObject $object)
    {
        $body = json_encode($object->export(true));

        $objectData = $this->unpackResponse(
            $this->client->patch($this->prefix . '/' . $object->getId(), [
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
