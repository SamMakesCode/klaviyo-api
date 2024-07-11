<?php

namespace SamMakesCode\KlaviyoApi\Resources;

use GuzzleHttp\Client;
use SamMakesCode\KlaviyoApi\Objects\BaseObject;
use SamMakesCode\KlaviyoApi\Objects\Profile;

/**
 * @method Profile get(string $id)
 * @method Profile[] list()
 */
class ProfilesResource extends WritableResource
{
    public function __construct(Client $client)
    {
        parent::__construct(
            $client,
            Profile::class,
            'profiles',
            'profile',
        );
    }

    public function createOrUpdate(array $attributes)
    {
        /** @var BaseObject $object */
        $object = $this->objectName;

        $event = $object::empty($attributes);

        $body = json_encode($event->toArray());

        $objectData = $this->unpackResponse(
            $this->client->post('profile-import', [
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
