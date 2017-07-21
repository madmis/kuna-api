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

    public function testMe()
    {
        $mock = $this->getMockBuilder(\madmis\KunaApi\Endpoint\PrivateEndpoint::class)
            ->disableOriginalConstructor()
            ->setMethods(['sendRequest', 'getApiUrn'])
            ->getMock();

        $mock->expects($this->any())
            ->method('sendRequest')
            ->will($this->returnValue([
                'email' => 'email',
                'activated' => true,
                'accounts' => [
                    [
                        'currency' => 'uah',
                        'balance' => 1000,
                        'locked' => 10,
                    ]
                ],
            ]));

        $response = $mock->me(false);

        static::assertInternalType('array', $response);
        static::assertEquals('email', $response['email']);
        static::assertEquals('uah', $response['accounts'][0]['currency']);

        $response = $mock->me(true);

        static::assertInstanceOf(\madmis\KunaApi\Model\Me::class, $response);
    }
}

\Doctrine\Common\Annotations\AnnotationRegistry::registerLoader('class_exists');