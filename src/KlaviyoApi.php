<?php

namespace SamMakesCode\KlaviyoApi;

use GuzzleHttp\Client;
use SamMakesCode\KlaviyoApi\Resources\EventsResource;
use SamMakesCode\KlaviyoApi\Resources\ProfilesResource;

class KlaviyoApi
{
    private Client $client;

    public function __construct(
        private readonly string $apiKey,
    ) {
        $this->client = new Client([
            'base_uri' => 'https://a.klaviyo.com/api/',
            'headers' => [
                'Authorization' => 'Klaviyo-API-Key ' . $this->apiKey,
                'Accept' => 'application/json',
                'revision' => '2024-06-15',
            ],
        ]);
    }

    public function events(): EventsResource
    {
        return new EventsResource($this->client);
    }

    public function profiles(): ProfilesResource
    {
        return new ProfilesResource($this->client);
    }
}
