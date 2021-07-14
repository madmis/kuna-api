<?php

namespace cryptopupua\KunaApi\Endpoint;

use madmis\ExchangeApi\Endpoint\AbstractEndpoint;
use madmis\ExchangeApi\Endpoint\EndpointInterface;
use madmis\ExchangeApi\Exception\ClientException;
use cryptopupua\KunaApi\Api;
use cryptopupua\KunaApi\Model\History;
use cryptopupua\KunaApi\Model\Order;
use cryptopupua\KunaApi\Model\Ticker;

/**
 * Class PublicEndpoint
 * @package cryptopupua\KunaApi\Endpoint
 */
class PublicEndpoint extends AbstractEndpoint implements EndpointInterface
{
    /**
     * Unix format timestamp - time from the exchange server
     * @link https://kuna.io/api/v2/timestamp
     * @return int
     * @throws ClientException
     */
    public function timestamp(): int
    {
        $request = $this->client->createRequest(Api::GET, $this->getApiUrn(['timestamp']));
        $response = $this->client->send($request);

        return (int)$response->getBody()->getContents();
    }

    /**
     * Recent Market Data
     * @link https://kuna.io/api/v2/tickers/btcuah
     * @param string $pair
     * @param bool $mapping
     *
     * @return array|Ticker
     * @throws ClientException
     */
    public function tickers(string $pair, bool $mapping = false)
    {
        $response = $this->sendRequest(Api::GET, $this->getApiUrn(['tickers', $pair]));

        if ($mapping) {
            $data = array_merge(['at' => $response['at']], $response['ticker']);
            $response = $this->deserializeItem($data, Ticker::class);
        }

        return $response;
    }

    /**
     * Order Book
     * @link https://kuna.io/api/v2/order_book?market=btcuah
     * @param string $pair
     * @param bool $mapping
     *
     * @return array|Order[] array with asks and bids
     * @throws ClientException
     */
    public function orderBook(string $pair, bool $mapping = false)
    {
        $options = [
            'query' => ['market' => $pair],
        ];
        $response = $this->sendRequest(Api::GET, $this->getApiUrn(['order_book']), $options);

        if ($mapping) {
            $response = [
                'asks' => $this->deserializeItems($response['asks'], Order::class),
                'bids' => $this->deserializeItems($response['bids'], Order::class),
            ];
        }

        return $response;
    }

    /**
     * Asks Order Book
     * @link https://kuna.io/api/v2/order_book?market=btcuah
     * @param string $pair
     * @param bool $mapping
     *
     * @return array|Order[]
     * @throws ClientException
     */
    public function asksOrderBook(string $pair, bool $mapping = false)
    {
        return $this->orderBook($pair, $mapping)['asks'];
    }

    /**
     * Bids Order Book
     * @link https://kuna.io/api/v2/order_book?market=btcuah
     * @param string $pair
     * @param bool $mapping
     *
     * @return array|Order[]
     * @throws ClientException
     */
    public function bidsOrderBook(string $pair, bool $mapping = false)
    {
        return $this->orderBook($pair, $mapping)['bids'];
    }

    /**
     * Trades History
     * @link https://kuna.io/api/v2/trades?market=btcuah
     * @param string $pair
     * @param int $limit
     * @param bool $mapping
     *
     * @return array|History[]
     * @throws ClientException
     */
    public function tradesHistory(string $pair, int $limit = 50, bool $mapping = false)
    {
        $options = [
            'query' => [
                'market' => $pair,
                'limit' => $limit,
            ],
        ];
        $response = $this->sendRequest(Api::GET, $this->getApiUrn(['trades']), $options);

        if ($mapping) {
            $response = $this->deserializeItems($response, History::class);
        }

        return $response;
    }

    /**
     * @param string $method Http::GET|POST
     * @param string $uri
     * @param array $options Request options to apply to the given
     *                                  request and to the transfer.
     *
     * @return array response
     * @throws ClientException
     */
    protected function sendRequest(string $method, string $uri, array $options = []): array
    {
        $request = $this->client->createRequest($method, $uri);

        return $this->processResponse(
            $this->client->send($request, $options)
        );

    }
}
