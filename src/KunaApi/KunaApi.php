<?php

namespace cryptopupua\KunaApi;

use Doctrine\Common\Annotations\AnnotationRegistry;
use madmis\ExchangeApi\Client\ClientInterface;
use madmis\ExchangeApi\Client\GuzzleClient;
use madmis\ExchangeApi\Endpoint\EndpointFactory;
use madmis\ExchangeApi\Endpoint\EndpointInterface;
use cryptopupua\KunaApi\Endpoint\PrivateEndpoint;
use cryptopupua\KunaApi\Endpoint\PublicEndpoint;

/**
 * Class KunaApi
 *
 * @package cryptopupua\KunaApi
 */
class KunaApi
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var string
     */
    private $publicKey;

    /**
     * @var string
     */
    private $secretKey;

    /**
     * @var EndpointFactory
     */
    private $endpointFactory;

    /**
     * @param string $baseUri example: http://localhost:8080
     * @param string $publicKey
     * @param string $secretKey
     * @param string $apiUrn  example: /api/v2
     * @param array  $options extra parameters
     */
    public function __construct(
        string $baseUri,
        string $publicKey,
        string $secretKey,
        string $apiUrn = '/api/v2',
        array $options = []
    ) {
        $this->client          = new GuzzleClient($baseUri, $apiUrn, $options);
        $this->publicKey       = $publicKey;
        $this->secretKey       = $secretKey;
        $this->endpointFactory = new EndpointFactory();
    }

    /**
     * @param ClientInterface $client
     */
    public function setClient(ClientInterface $client): void
    {
        $this->client = $client;
    }

    /**
     * @return ClientInterface
     */
    public function getClient(): ClientInterface
    {
        return $this->client;
    }

    /**
     * @return PublicEndpoint|EndpointInterface
     */
    public function shared(): PublicEndpoint
    {
        return $this
            ->endpointFactory
            ->getEndpoint(PublicEndpoint::class, $this->client);
    }

    /**
     * @return PrivateEndpoint|EndpointInterface
     */
    public function signed(): PrivateEndpoint
    {
        $options = [
            'publicKey' => $this->publicKey,
            'secretKey' => $this->secretKey,
        ];

        return $this
            ->endpointFactory
            ->getEndpoint(PrivateEndpoint::class, $this->client, $options);
    }
}

AnnotationRegistry::registerLoader('class_exists');
