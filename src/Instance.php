<?php namespace Rackr\DigitalOcean;

use Rackr\Cloud\GatewayInterface;
use Rackr\Cloud\InstanceInterface;

class Instance implements InstanceInterface
{
    /**
     * @var GatewayInterface
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
     * @return GatewayInterface
     */
    public function gateway()
    {
        return $this->gateway;
    }

    /**
     * Create a new instance on the gateway.
     *
     * @param $size
     * @param $region
     * @return array
     */
    public function create($size, $region)
    {
        // TODO: Implement create() method.
    }

    /**
     * Get details about the instance.
     *
     * @param $identifier
     * @return array
     */
    public function info($identifier)
    {
        // TODO: Implement info() method.
    }

    /**
     * Update details about an instance.
     *
     * @param $identifier
     * @param array $details
     * @return mixed
     */
    public function update($identifier, array $details)
    {
        // TODO: Implement update() method.
    }

    /**
     * Destroy an instance.
     *
     * @param $identifier
     * @return mixed
     */
    public function destroy($identifier)
    {
        // TODO: Implement destroy() method.
    }

    /**
     * List all instances.
     *
     * @return array
     */
    public function all()
    {
        return $this->gateway()->get('droplets')->only('droplets');
    }

    /**
     * Power on an instance.
     *
     * @param $identifier
     * @return array
     */
    public function on($identifier)
    {
        // TODO: Implement on() method.
    }

    /**
     * Power off an instance.
     *
     * @param $identifier
     * @return array
     */
    public function off($identifier)
    {
        // TODO: Implement off() method.
    }
}