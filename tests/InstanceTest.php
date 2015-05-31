<?php

use Rackr\DigitalOcean\Instance;

class InstanceTest extends PHPUnit_Framework_TestCase {

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
        $response->only('droplet')->willReturn();

        $this->gateway  ->post('droplets', [ 'body' => compact('name', 'size', 'region', 'image') ])
                        ->willReturn($response);
        ;

        $this->instance->create($name, $size, $region, $image);
    }

    /** @test */
    public function it_gets_an_instances_info()
    {
        $response = $this->prophesize('Rackr\Cloud\Response');
        $response->only('droplet')->willReturn();

        $this->gateway->get('droplets/123')->willReturn($response);

        $this->instance->info(123);
    }

    /** @test */
    public function it_destroys_an_instance()
    {
        $this->gateway->delete('droplets/123');

        $this->instance->destroy(123);
    }

    /** @test */
    public function it_gets_all_instances()
    {
        $response = $this->prophesize('Rackr\Cloud\Response');
        $response->only('droplets')->willReturn();

        $this->gateway->get('droplets')->willReturn($response);

        $this->instance->all();
    }

    /** @test */
    public function it_powers_on_an_an_instance()
    {
        $response = $this->prophesize('Rackr\Cloud\Response');
        $response->only('action')->willReturn();

        $this->gateway->post('droplets/123/actions', ['body' => ['type' => 'power_on']])->willReturn($response);

        $this->instance->on(123);
    }

    /** @test */
    public function it_powers_off_an_an_instance()
    {
        $response = $this->prophesize('Rackr\Cloud\Response');
        $response->only('action')->willReturn();

        $this->gateway->post('droplets/123/actions', ['body' => ['type' => 'power_off']])->willReturn($response);

        $this->instance->off(123);
    }
}