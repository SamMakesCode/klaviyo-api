<?php

namespace SamMakesCode\Tests\Unit;

use SamMakesCode\KlaviyoApi\Objects\Profile;

class ProfilesTest extends CustomTestCase
{
    public function testCanCreateProfiles()
    {
        $number = rand(1000000, 9999999);

        $profile = $this->klaviyoApi->profiles()->create(Profile::make([
            'email' => $number . '@example.org',
        ]));

        $this->assertInstanceOf(Profile::class, $profile);
    }

    public function testCanGetProfile()
    {
        $id = '01HXYH0637H0EC6PGQGPKA09K9';

        $profile = $this->klaviyoApi->profiles()->get($id);

        $this->assertInstanceOf(Profile::class, $profile);
        $this->assertEquals($id, $profile->getId());
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

        $object = Profile::make([
            'phone_number' => $phoneNumber,
        ]);
        $object->setId('01HXYH0637H0EC6PGQGPKA09K9');
        $profile = $this->klaviyoApi->profiles()->update($object);

        $this->assertInstanceOf(Profile::class, $profile);
        $this->assertEquals($phoneNumber, $profile->getAttributes()->get('phone_number'));
    }

    public function testCanCreateOrUpdate()
    {
        $variableBit = rand(0, 999999999);
        $variableBit = str_pad($variableBit,9, '0', STR_PAD_LEFT);
        $phoneNumber = '+447' . $variableBit;

        $profile = $this->klaviyoApi->profiles()->createOrUpdate(
            Profile::make([
                'email' => 'john@example.org',
                'phone_number' => $phoneNumber,
            ])
        );

        $this->assertInstanceOf(Profile::class, $profile);
        $this->assertEquals($phoneNumber, $profile->getAttributes()->get('phone_number'));
    }
}
