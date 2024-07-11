<?php

namespace SamMakesCode\Tests\Unit;

use SamMakesCode\KlaviyoApi\Objects\Profile;

class ProfilesTest extends CustomTestCase
{
    public function testCanCreateProfiles()
    {
        $number = rand(1000000, 9999999);

        $profile = $this->klaviyoApi->profiles()->create([
            'email' => $number . '@example.org',
        ]);

        $this->assertInstanceOf(Profile::class, $profile);
    }

    public function testCanGetProfile()
    {
        $id = '01HXYH0637H0EC6PGQGPKA09K9';

        $profile = $this->klaviyoApi->profiles()->get($id);

        $this->expectException(\InvalidArgumentException::class);
        echo $profile->attributes->someMadeUpPropertyThatDoesntExist;

        $this->assertInstanceOf(Profile::class, $profile);
        $this->assertEquals($id, $profile->id);
    }

    public function testCanListProfiles()
    {
        $profiles = $this->klaviyoApi->profiles()->list();

        $this->assertIsArray($profiles);
    }

    public function testCanUpdateProfiles()
    {
        $variableBit = rand(0, 999999999);
        $variableBit = str_pad($variableBit,9, '0', STR_PAD_LEFT);
        $phoneNumber = '+447' . $variableBit;

        $profile = $this->klaviyoApi->profiles()->update('01HXYH0637H0EC6PGQGPKA09K9', [
            'phone_number' => $phoneNumber,
        ]);

        $this->assertInstanceOf(Profile::class, $profile);
        $this->assertEquals($phoneNumber, $profile->attributes->phone_number);
    }
}
