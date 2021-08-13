<?php

namespace cryptopupua\KunaApi\Exception;

use Psr\Http\Message\RequestInterface;

/**
 * Class IncorrectResponseException
 * @package cryptopupua\KunaApi\Exception
 */
class IncorrectResponseException extends \RuntimeException implements KunaApiExceptionInterface
{
    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var array
     */
    private $response;

    /**
     * @param string           $message
     * @param RequestInterface $request
     * @param array            $response
     */
    public function __construct(string $message, RequestInterface $request, array $response)
    {
        parent::__construct($message);
        $this->request  = $request;
        $this->response = $response;
    }


    /**
     * Get the request that caused the exception
     *
     * @return RequestInterface
     */
    public function getRequest(): RequestInterface
    {
        return $this->request;
    }

    /**
     * Get the associated response
     *
     * @return array
     */
    public function getResponse(): array
    {
        return $this->response;
    }
}
