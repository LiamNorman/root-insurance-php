<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Client;

abstract class FunctionalTestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Get new mock Guzzle client
     * @param $responseCode
     * @param $body
     * @return Client
     */
    public function getMockClient($responseCode, $body)
    {
        $mock = new MockHandler([
            new Response($responseCode, [], $body),
        ]);
        $handler = HandlerStack::create($mock);

        return new Client(['handler' => $handler]);
    }

}
