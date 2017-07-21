<?php

use madmis\KunaApi\Client\GuzzleClient;
use madmis\KunaApi\Endpoint\EndpointFactory;

class EndpointFactoryTest extends \PHPUnit\Framework\TestCase
{
    public function testGetEndpoint()
    {
        $factory = new EndpointFactory();
        $client = new GuzzleClient('', '', []);

        $actual = $factory->getEndpoint('public', $client);

        $this->assertInstanceOf(\madmis\KunaApi\Endpoint\PublicEndpoint::class, $actual);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testGetEndpointError()
    {
        $factory = new EndpointFactory();
        $client = new GuzzleClient('', '', []);

        $factory->getEndpoint('test', $client);
    }
}