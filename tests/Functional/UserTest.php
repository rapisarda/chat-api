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

        static::createClient()->request('POST', '/authentication_token', ['json' => [
            'email' => 'test.post@phpunit.com',
            'password' => 'error',
        ]]);
        static::assertResponseStatusCodeSame(401);
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

    public function testPut()
    {
        static::createClient()->request('PUT', '/users/123456', ['json' => ['email' => 'error@404.com']]);
        static::assertResponseStatusCodeSame(404);
        static::createClient()->request('PUT', '/users/1', ['json' => ['email' => 'error@401.com']]);
        static::assertResponseStatusCodeSame(401);
        static::logIn();
        static::createClient()->request('PUT', '/users/2', ['json' => ['email' => 'user1@403.com']]);
        static::assertResponseStatusCodeSame(403);
        static::createClient()->request('PUT', '/users/1', ['json' => ['email' => 'user1@200.com']]);
        static::assertResponseStatusCodeSame(200);
    }

    public function testDelete()
    {
        static::createClient()->request('DELETE', '/users/123456', ['json' => ['email' => 'error@404.com']]);
        static::assertResponseStatusCodeSame(404);
        static::createClient()->request('DELETE', '/users/1', ['json' => ['email' => 'error@401.com']]);
        static::assertResponseStatusCodeSame(401);
        static::logIn();
        static::createClient()->request('DELETE', '/users/2', ['json' => ['email' => 'user1@403.com']]);
        static::assertResponseStatusCodeSame(403);
        static::createClient()->request('DELETE', '/users/1', ['json' => ['email' => 'user1@200.com']]);
        static::assertResponseStatusCodeSame(204);
    }
}
