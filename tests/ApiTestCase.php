<?php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\Client;

class ApiTestCase extends \ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase
{
    protected static ?string $token = null;

    protected static function createClient(array $kernelOptions = [], array $defaultOptions = []): Client
    {
        if (null !== static::$token) {
            $defaultOptions = array_merge($defaultOptions, ['Authorization' => ['Bearer '.static::$token]]);
        }

        return parent::createClient($kernelOptions, $defaultOptions);
    }

    protected static function login(array $parameters): void
    {
        $body = static::createClient()->request('POST', '/authentication_token', ['json' => $parameters])->toArray();
        static::$token = $body['token'];
    }
}