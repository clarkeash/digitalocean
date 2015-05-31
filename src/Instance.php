<?php namespace Rackr\DigitalOcean;

use Rackr\Cloud\GatewayInterface;
use Rackr\Cloud\InstanceInterface;
use Rackr\Cloud\Reponse;
use Rackr\Cloud\Response;

class Instance implements InstanceInterface
{
    /**
     * @var Gateway
     */
    protected $gateway;

    /**
     * @param GatewayInterface $gateway
     */
    public function __construct(GatewayInterface $gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * Returns the parent gateway.
     *
     * @return Gateway
     */
    public function gateway()
    {
        return $this->gateway;
    }

    /**
     * Create a new instance on the gateway.
     *
     * @param $name
     * @param $size
     * @param $region
     * @param $image
     * @return Response
     */
    public function create($name, $size, $region, $image)
    {
        return $this->gateway()->post('droplets', [
            'body' => [
                'name' => $name,
                'region' => $region,
                'size' => $size,
                'image' => $image
            ]
        ])->only('droplet');
    }

    /**
     * Get details about the instance.
     *
     * @param $identifier
     * @return Response
     */
    public function info($identifier)
    {
        return $this->gateway()->get(sprintf('droplets/%d', $identifier))->only('droplet');
    }

    /**
     * Update details about an instance.
     *
     * @param $identifier
     * @param array $details
     * @return Response
     */
    public function update($identifier, array $details)
    {
        // TODO: Implement update() method.
    }

    /**
     * Destroy an instance.
     *
     * @param $identifier
     * @return Response
     */
    public function destroy($identifier)
    {
        $this->gateway()->delete(sprintf('droplets/%d', $identifier));

        // TODO: this returns no response data just a 204, we should interpret that and build a response with data and code.
    }

    /**
     * List all instances.
     *
     * @return Response
     */
    public function all()
    {
        return $this->gateway()->get('droplets')->only('droplets');
    }

    /**
     * Power on an instance.
     *
     * @param $identifier
     * @return Response
     */
    public function on($identifier)
    {
        return $this->action($identifier, 'power_on');
    }

    /**
     * Power off an instance.
     *
     * @param $identifier
     * @return Response
     */
    public function off($identifier)
    {
        return $this->action($identifier, 'power_off');
    }

    /**
     * @param $identifier
     * @param $type
     * @return Response
     */
    protected function action($identifier, $type)
    {
        return $this->gateway()->post(sprintf('droplets/%d/actions', $identifier), [
            'body' => [
                'type' => $type
            ]
        ])->only('action');
    }
}