<?php

namespace Rackr\DigitalOcean;

use GuzzleHttp\Client;
use Rackr\Cloud\GatewayInterface;
use Rackr\Cloud\InstanceInterface;

class DigitalOceanGateway implements GatewayInterface
{
    use HttpGatewayTrait;

    /**
     * The gateways api endpoint.
     *
     * @var string
     */
    protected $endpoint = 'https://api.digitalocean.com/v2/';

    /**
     * Guzzles Http Client.
     *
     * @var Client
     */
    protected $client;

    /**
     * Configuration options.
     *
     * @var array
     */
    protected $config;

    public function __construct(Client $client, array $config)
    {
        $this->client = $client;
        $this->config = $config;
    }

    /**
     * List of the available server types/sizes.
     *
     * @return array
     */
    public function sizes()
    {
        return $this->get('sizes')->only('sizes');
    }

    /**
     * List of the available server regions/zones.
     *
     * @return array
     */
    public function regions()
    {
        return $this->get('regions')->only('regions');
    }

    /**
     * An instance manager for the gateway.
     *
     * @return InstanceInterface
     */
    public function instance()
    {
        // TODO: Implement instance() method.
    }
}