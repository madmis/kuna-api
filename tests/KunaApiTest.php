<?php


class KunaApiTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @expectedException TypeError
     */
    public function testSetClient()
    {
        $api = new \madmis\KunaApi\KunaApi('http://localhost', 'pub', 'sec');

        $api->setClient(new \GuzzleHttp\Client());
    }

    public function testGetClient()
    {
        $api = new \madmis\KunaApi\KunaApi('http://localhost', 'pub', 'sec');

        $this->assertInstanceOf(
            \madmis\KunaApi\Client\GuzzleClient::class,
            $api->getClient()
        );

        $mock = $this->createMock(\madmis\KunaApi\Client\ClientInterface::class);
        $api->setClient($mock);
        $this->assertInstanceOf(
            \madmis\KunaApi\Client\ClientInterface::class,
            $api->getClient()
        );
    }

    public function testGetShared()
    {
        $api = new \madmis\KunaApi\KunaApi('http://localhost', 'pub', 'sec');

        $this->assertInstanceOf(
            \madmis\KunaApi\Endpoint\PublicEndpoint::class,
            $api->shared()
        );
    }

    public function testGetSigned()
    {
        $api = new \madmis\KunaApi\KunaApi('http://localhost', 'pub', 'sec');

        $this->assertInstanceOf(
            \madmis\KunaApi\Endpoint\PrivateEndpoint::class,
            $api->signed()
        );
    }
}