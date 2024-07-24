<?php

namespace SamMakesCode\KlaviyoApi\Resources;

use GuzzleHttp\Client;
use SamMakesCode\KlaviyoApi\Objects\Metric;

/**
 * @method Metric get(string $id)
 * @method Metric[] list()
 */
class MetricResource extends BaseResource
{
    public function __construct(Client $client)
    {
        parent::__construct(
            $client,
            Metric::class,
            'metrics',
        );
    }
}
