<?php

namespace App\Tests\Functional\Chat;

use App\Tests\ApiTestCase;

class Chanel extends ApiTestCase
{
    public function testGetList(): void
    {
        static::createClient()->request('GET', '/chanels');
        static::assertResponseStatusCodeSame(401);
        static::logIn();
        static::createClient()->request('GET', '/chanels');
        static::assertResponseStatusCodeSame(200);
    }
}