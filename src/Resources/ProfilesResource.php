<?php

namespace SamMakesCode\KlaviyoApi\Resources;

use GuzzleHttp\Client;
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
}
