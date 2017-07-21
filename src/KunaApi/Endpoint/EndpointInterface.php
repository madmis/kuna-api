<?php

namespace madmis\KunaApi\Endpoint;

use madmis\KunaApi\Client\ClientInterface;

/**
 * Interface EndpointInterface
 *
 * @package madmis\KunaApi\Endpoint
 */
interface EndpointInterface
{
    /**
     * @param ClientInterface $client
     * @param array $options
     */
    public function __construct(ClientInterface $client, array $options = []);
}
