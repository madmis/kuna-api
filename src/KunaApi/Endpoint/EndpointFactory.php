<?php

namespace madmis\KunaApi\Endpoint;

use madmis\KunaApi\Client\ClientInterface;

/**
 * Class EndpointFactory
 *
 * @package madmis\KunaApi\Endpoint
 */
class EndpointFactory
{
    /**
     * @var array
     */
    protected $endpointList = [];

    /**
     * @param string $type endpoint type or class
     * @param ClientInterface $client
     * @param array $options additional endpoint options
     * @return EndpointInterface
     * @throws \InvalidArgumentException
     */
    public function getEndpoint(string $type, ClientInterface $client, array $options = []): EndpointInterface
    {
        if (!array_key_exists($type, $this->endpointList)) {
            if (class_exists($type)) {
                $this->endpointList[$type] = new $type($client, $options);
            } else {
                $className = sprintf('%s\%sEndpoint', __NAMESPACE__, ucfirst($type));
                if (!class_exists($className)) {
                    throw new \InvalidArgumentException("{$className} is not valid endpoint");
                }

                $this->endpointList[$type] = new $className($client);
            }
        }

        return $this->endpointList[$type];
    }
}
