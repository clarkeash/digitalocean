<?php

namespace Rackr\DigitalOcean;

use GuzzleHttp\Client;
use Rackr\Cloud\GatewayInterface;
use Rackr\Cloud\HttpGatewayTrait;
use Rackr\Cloud\InstanceInterface;
use Rackr\Cloud\Response;

class Gateway implements GatewayInterface
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

    /**
     * @param Client $client
     * @param array $config
     */
    public function __construct(Client $client, array $config)
    {
        $this->client = $client;
        $this->config = $config;
    }

    /**
     * List of the available server types/sizes.
     *
     * @return Response
     */
    public function sizes()
    {
        return $this->get('sizes')->only('sizes');
    }

    /**
     * List of the available server regions/zones.
     *
     * @return Response
     */
    public function regions()
    {
        return $this->get('regions')->only('regions');
    }

    /**
     * List of the available distributions.
     *
     * @return Response
     */
    public function images()
    {
        return $this->get(sprintf('images?type=distribution&per_page=%d', PHP_INT_MAX))->only('images');
    }

    /**
     * An instance manager for the gateway.
     *
     * @return InstanceInterface
     */
    public function instance()
    {
        return new Instance($this);
    }

    /**
     * @param $method
     * @param $endpoint
     * @param array $options
     * @return Response
     */
    protected function send($method, $endpoint, $options = [])
    {
        $conf = [
            'headers' => [ 'Authorization' => 'Bearer ' . $this->config['token'] ],
        ];

        $guzzleResp = $this->client->{$method}($this->endpoint($endpoint), array_merge($conf, $options));

        return Response::make($guzzleResp->getBody()->getContents());
    }
}