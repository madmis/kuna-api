<?php

class PrivateEndpointTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @expectedException \Symfony\Component\OptionsResolver\Exception\MissingOptionsException
     */
    public function testNoOptions()
    {
        $client = new \madmis\KunaApi\Client\GuzzleClient('', '', []);

        new \madmis\KunaApi\Endpoint\PrivateEndpoint($client);
    }

    /**
     * @expectedException \Symfony\Component\OptionsResolver\Exception\InvalidOptionsException
     */
    public function testInvalidTypeOption()
    {
        $client = new \madmis\KunaApi\Client\GuzzleClient('', '', []);

        new \madmis\KunaApi\Endpoint\PrivateEndpoint($client, ['publicKey' => '', 'secretKey' => null]);
    }
}