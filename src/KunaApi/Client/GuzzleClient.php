<?php

namespace madmis\KunaApi\Client;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use madmis\KunaApi\Exception\ClientException;

/**
 * Class GuzzleClient
 *
 * @package madmis\KunaApi\Client
 */
class GuzzleClient extends Client implements ClientInterface
{
    /**
     * @var string
     */
    private $apiUrn;

    /**
     * @var array
     */
    private $options;

    /**
     * @var RequestInterface
     */
    private $lastRequest;

    /**
     * @var ResponseInterface
     */
    private $lastResponse;

    /**
     * @param string $baseUri example: http://kuna.io
     * @param string $apiUrn example: /api/v2
     * @param array $options extra parameters
     */
    public function __construct(string $baseUri, string $apiUrn, array $options)
    {
        parent::__construct([
            'base_uri' => trim($baseUri, '/'),
        ]);
        $this->apiUrn = $apiUrn;
        $this->options = $options;
    }

    /**
     * @param RequestInterface $request
     * @param array $options
     * @return ResponseInterface
     * @throws ClientException
     */
    public function send(RequestInterface $request, array $options = []): ResponseInterface
    {
        try {
            /** @var ResponseInterface $response */
            $response = parent::send($request, $options);
        } catch (RequestException $ex) {
            $this->lastRequest = $ex->getRequest();
            $this->lastResponse = $ex->getResponse();
            throw new ClientException($ex, $ex->getRequest(), $ex->getResponse());
        }
        $this->lastRequest = $request;
        $this->lastResponse = $response;

        return $response;
    }

    /**
     * Get api urn (example: /api/v2)
     *
     * @return string
     */
    public function getApiUrn(): string
    {
        return $this->apiUrn;
    }

    /**
     * @param string $name
     * @return mixed null if option doesn't exists
     */
    public function getOption(string $name)
    {
        return $this->options[$name] ?? null;
    }

    /**
     * @return RequestInterface
     */
    public function getLastRequest(): RequestInterface
    {
        return $this->lastRequest;
    }

    /**
     * @return ResponseInterface
     */
    public function getLastResponse(): ResponseInterface
    {
        return $this->lastResponse;
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $headers
     * @return RequestInterface
     */
    public function createRequest(string $method, string $uri, array $headers = []): RequestInterface
    {
        return new Request($method, $uri, $headers);
    }
}
