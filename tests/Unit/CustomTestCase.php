<?php

namespace SamMakesCode\Tests\Unit;

use PHPUnit\Framework\TestCase;
use SamMakesCode\KlaviyoApi\KlaviyoApi;

class CustomTestCase extends TestCase
{
    protected KlaviyoApi $klaviyoApi;

    protected function setUp(): void
    {
        parent::setUp();

        $this->klaviyoApi = new KlaviyoApi('');
    }
}
