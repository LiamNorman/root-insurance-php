<?php

namespace Tests;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Client;

abstract class FunctionalTestCase extends \PHPUnit\Framework\TestCase
{

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
