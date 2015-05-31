<?php

use Rackr\DigitalOcean\Instance;

class InstanceTest extends TestCase {

    /**
     * @var \Prophecy\Prophecy\ObjectProphecy
     */
    protected $guzzle;

    /**
     * @var \Prophecy\Prophecy\ObjectProphecy
     */
    protected $gateway;

    /**
     * @var Rackr\DigitalOcean\Instance
     */
    protected $instance;

    public function setUp()
    {
        $this->guzzle = $this->prophesize('GuzzleHttp\Client');
        $this->gateway = $this->prophesize('Rackr\DigitalOcean\Gateway');

        $this->instance = new Instance($this->gateway->reveal());
    }

    /** @test */
    public function it_is_an_instance_of_instance_interface()
    {
        $this->assertInstanceOf('Rackr\Cloud\InstanceInterface', $this->instance);
    }

    /** @test */
    public function it_creates_an_instance()
    {
        $name = 'example.com';
        $size = '1gb';
        $region = 'nyc1';
        $image = 'ubuntu-14-04-x64';

        $response = $this->prophesize('Rackr\Cloud\Response');
        $response->only('droplet')->willReturn([]);

        $this->gateway  ->post('droplets', [ 'body' => compact('name', 'size', 'region', 'image') ])
                        ->willReturn($response);
        ;

        $this->instance->create($name, $size, $region, $image);
    }
}