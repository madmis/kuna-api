<?php

namespace madmis\KunaApi\Client;

use madmis\KunaApi\Exception\ClientException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Interface ClientInterface
 */
interface ClientInterface
{
    /**
     * Send an HTTP request.
     *
     * @param RequestInterface $request Request to send
     * @param array            $options Request options to apply to the given
     *                                  request and to the transfer.
     *
     * @return ResponseInterface
     * @throws ClientException
     */
    public function send(RequestInterface $request, array $options = []): ResponseInterface;

    /**
     * Get api uri
     * @return string
     */
    public function getApiUrn(): string;

    /**
     * @param string $name
     *
     * @return mixed null if option doesn't exists
     */
    public function getOption(string $name);

    /**
     * @return RequestInterface
     */
    public function getLastRequest(): RequestInterface;

    /**
     * @return ResponseInterface
     */
    public function getLastResponse(): ResponseInterface;

    /**
     * @param string $method
     * @param string $uri
     * @param array  $headers
     *
     * @return RequestInterface
     */
    public function createRequest(string $method, string $uri, array $headers = []): RequestInterface;
}
