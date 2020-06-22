<?php

namespace App\Tests\Functional;

use App\Tests\ApiTestCase;

class UserTest extends ApiTestCase
{
    public function testCreateUserAndLogin(): void
    {
        $userLogin = [
            'email' => 'test.post@phpunit.com',
            'password' => 'Pa$$w0rd',
        ];
        static::createClient()->request('POST', '/users', ['json' => $userLogin]);

        static::assertResponseStatusCodeSame(201);
        static::assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        static::assertJsonContains([
            '@context' => '/contexts/User',
            '@type' => 'User',
            'email' => $userLogin['email']
        ]);

        $body = static::createClient()->request('POST', '/authentication_token', ['json' => $userLogin])->toArray();
        static::assertResponseStatusCodeSame(200);
        static::assertArrayHasKey('token', $body);
    }
}
