<?php

namespace madmis\KunaApi\Endpoint;

use madmis\KunaApi\Client\ClientInterface;
use madmis\KunaApi\Exception\ClientException;
use madmis\KunaApi\Http;
use madmis\KunaApi\Model\History;
use madmis\KunaApi\Model\Me;
use madmis\KunaApi\Model\Order;
use Symfony\Component\OptionsResolver\Exception\AccessException;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class PrivateEndpoint
 * @package madmis\KunaApi\Endpoint
 */
class PrivateEndpoint extends AbstractEndpoint implements EndpointInterface
{
    /**
     * @param ClientInterface $client
     * @param array $options
     */
    public function __construct(ClientInterface $client, array $options = [])
    {
        $resolver = new OptionsResolver();
        $this->configureOptions($resolver);

        parent::__construct($client, $resolver->resolve($options));
    }

    /**
     * @param bool $mapping
     * @return array|Me
     * @throws ClientException
     */
    public function me(bool $mapping = false)
    {
        $response = $this->sendRequest(Http::GET, $this->getApiUrn(['members', 'me']));

        if ($mapping) {
            $response = $this->deserializeItem($response, Me::class);
        }

        return $response;
    }

    /**
     * @param string $pair
     * @param float $volume volume in base currency
     * @param float $price price per base currency unit
     * @param bool $mapping
     * @return array|Order
     * @throws ClientException
     */
    public function createBuyOrder(string $pair, float $volume, float $price, bool $mapping = false)
    {
        return $this->createOrder('buy', $pair, $volume, $price, $mapping);
    }

    /**
     * @param string $pair
     * @param float $volume volume in base currency
     * @param float $price price per base currency unit
     * @param bool $mapping
     * @return array|Order
     * @throws ClientException
     */
    public function createSellOrder(string $pair, float $volume, float $price, bool $mapping = false)
    {
        return $this->createOrder('sell', $pair, $volume, $price, $mapping);
    }

    /**
     * @param string $side
     * @param string $pair
     * @param float $volume volume in base currency
     * @param float $price price per base currency unit
     * @param bool $mapping
     * @return array|Order
     * @throws ClientException
     */
    protected function createOrder(string $side, string $pair, float $volume, float $price, bool $mapping = false)
    {
        $options = [
            'form_params' => [
                'side' => $side,
                'market' => $pair,
                'volume' => $volume,
                'price' => $price,
            ],
        ];

        $response = $this->sendRequest(Http::POST, $this->getApiUrn(['orders']), $options);

        if ($mapping) {
            $response = $this->deserializeItem($response, Order::class);
        }

        return $response;
    }

    /**
     * @param int $orderId
     * @param bool $mapping
     * @return array|Order
     * @throws ClientException
     */
    public function cancelOrder(int $orderId, bool $mapping = false)
    {
        $options = ['form_params' => ['id' => $orderId]];
        $response = $this->sendRequest(Http::POST, $this->getApiUrn(['order', 'delete']), $options);

        if ($mapping) {
            $response = $this->deserializeItem($response, Order::class);
        }

        return $response;
    }

    /**
     * @param string $pair
     * @param bool $mapping
     * @return array|Order[]
     * @throws ClientException
     */
    public function activeOrders(string $pair, bool $mapping = false): array
    {
        $options = [
            'query' => ['market' => $pair],
        ];
        $response = $this->sendRequest(Http::GET, $this->getApiUrn(['orders']), $options);

        if ($mapping) {
            $response = $this->deserializeItems($response, Order::class);
        }

        return $response;
    }

    /**
     * @param string $pair
     * @param bool $mapping
     * @return array|History[]
     * @throws ClientException
     */
    public function myHistory(string $pair, bool $mapping = false): array
    {
        $options = [
            'query' => ['market' => $pair],
        ];
        $response = $this->sendRequest(Http::GET, $this->getApiUrn(['trades', 'my']), $options);

        if ($mapping) {
            $response = $this->deserializeItems($response, History::class);
        }

        return $response;
    }


    /**
     * @param OptionsResolver $resolver
     * @throws AccessException
     */
    protected function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired(['publicKey', 'secretKey']);
        $resolver->setAllowedTypes('publicKey', 'string');
        $resolver->setAllowedTypes('secretKey', 'string');
    }

    /**
     * @param string $method Http::GET|POST
     * @param string $uri
     * @param array $options Request options to apply to the given
     *                                  request and to the transfer.
     * @return array response
     * @throws ClientException
     */
    protected function sendRequest(string $method, string $uri, array $options = []): array
    {
        $request = $this->client->createRequest($method, $uri);

        $options['query'] = $this->signQuery(
            $method,
            $request->getUri()->__toString(),
            $options['query'] ?? []
        );

        return $this->processResponse(
            $this->client->send($request, $options)
        );
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $query
     * @return array
     */
    protected function signQuery(string $method, string $uri, array $query): array
    {
        $query = array_merge($query, [
            'tonce' => $this->getTonce(),
            'access_key' => $this->options['publicKey'],
        ]);
        ksort($query, SORT_STRING);
        $sign = implode('|', [$method, $uri, http_build_query($query)]);
        $query['signature'] = hash_hmac('SHA256', $sign, $this->options['secretKey']);

        return $query;
    }

    /**
     * @return int
     */
    private function getTonce(): int
    {
        return (int)(microtime(true) * 1000);
    }
}
