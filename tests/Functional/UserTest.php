<?php

namespace App\Tests\Functional;

use App\Tests\ApiTestCase;

class UserTest extends ApiTestCase
{
    public function testPost()
    {
        static::createClient()->request('POST', '/users', ['json' => [
            'email' => 'test.post@phpunit.com',
            'password' => 'Pa$$w0rd',
        ]]);

        static::assertResponseStatusCodeSame(201);
        static::assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        static::assertJsonContains([
            '@context' => '/contexts/User',
            '@type' => 'User',
            'email' => 'test.post@phpunit.com'
        ]);
    }
}
