<?php

namespace Exception;

use GuzzleHttp\Psr7\Request;
use cryptopupua\KunaApi\Exception\IncorrectResponseException;
use PHPUnit\Framework\TestCase;

/**
 * Class IncorrectResponseExceptionTest
 * @package Exception
 */
class IncorrectResponseExceptionTest extends TestCase
{
    public function testException()
    {
        $e = new IncorrectResponseException(
            'Test message',
            new Request('GET', '/'),
            ['data' => 'real data']
        );

        static::assertNotNull($e->getRequest());
        static::assertNotNull($e->getResponse());

        static::assertEquals('real data', $e->getResponse()['data']);
    }
}
