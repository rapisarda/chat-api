<?php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\Client;

class ApiTestCase extends \ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase
{
    protected static ?string $token = null;

    public function setUp(): void
    {
        static::$token = null;
    }

    protected static function createClient(array $kernelOptions = [], array $defaultOptions = []): Client
    {
        if (null !== static::$token) {
            $defaultOptions = array_merge($defaultOptions, ['headers' => ['Authorization' => ['Bearer '.static::$token]]]);
        }

        return parent::createClient($kernelOptions, $defaultOptions);
    }

    protected static function logIn(string $username = 'user1@test.com'): void
    {
        static::$token = self::bootKernel()
            ->getContainer()
            ->get('lexik_jwt_authentication.encoder')
            ->encode(['username' => $username]);
    }
}