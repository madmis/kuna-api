<?php

/**
 * Class EndpointTest
 */
class EndpointTest extends \PHPUnit\Framework\TestCase
{
    public function testGetApiUrn()
    {
        $client = new \madmis\KunaApi\Client\GuzzleClient('http://localhost', '/api/v2', []);
        $endpoint = new \madmis\KunaApi\Endpoint\PublicEndpoint($client);


        static::assertEquals('/api/v2', $endpoint->getApiUrn());
        static::assertEquals('/api/v2', $endpoint->getApiUrn(['/']));
        static::assertEquals('/api/v2/test', $endpoint->getApiUrn(['/test']));
        static::assertEquals('/api/v2/test/ac', $endpoint->getApiUrn(['/test/', 'ac/']));
    }
}