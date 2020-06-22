<?php

namespace App\Tests\Functional;

use App\Tests\ApiTestCase;

class UserTest extends ApiTestCase
{
    protected const PASSWORD = 'Pa$$w0rd';

    public function testCreateUserAndLogin(): void
    {
        $userLogin = [
            'email' => 'test.post@phpunit.com',
            'password' => self::PASSWORD,
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

    public function testGetList(): void
    {
        static::createClient()->request('GET', '/users');
        static::assertResponseStatusCodeSame(401);

        static::login('user1@test.com');
        static::createClient()->request('GET', '/users');
    }
}
