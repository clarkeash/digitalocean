<?php

use Rackr\DigitalOcean\Gateway;

class GatewayTest extends TestCase {

    /**
     * @var \Prophecy\Prophecy\ObjectProphecy
     */
    protected $guzzle;

    /**
     * @var Gateway
     */
    protected $gateway;

    public function setUp()
    {
        $this->guzzle = $this->prophesize('GuzzleHttp\Client');
        $this->gateway = new Gateway($this->guzzle->reveal(), ['token' => 'FAKE']);
    }

    /** @test */
    public function it_is_an_instance_of_gateway_interface()
    {
        $this->assertInstanceOf('Rackr\Cloud\GatewayInterface', $this->gateway);
    }

    /** @test */
    public function it_gets_the_available_sizes()
    {
        $guzzleResp = $this->guzzleResp(['sizes' => [] ]);

        $this->guzzle->get('https://api.digitalocean.com/v2/sizes', ["headers" => ["Authorization" => "Bearer FAKE"]])
            ->willReturn($guzzleResp);

        $resp = $this->gateway->sizes();

        $this->assertInstanceOf('Rackr\Cloud\Response', $resp);
    }

    /** @test */
    public function it_gets_the_available_regions()
    {
        $guzzleResp = $this->guzzleResp(['regions' => [] ]);

        $this->guzzle->get('https://api.digitalocean.com/v2/regions', ["headers" => ["Authorization" => "Bearer FAKE"]])
            ->willReturn($guzzleResp);

        $resp = $this->gateway->regions();

        $this->assertInstanceOf('Rackr\Cloud\Response', $resp);
    }

    /** @test */
    public function it_gets_the_available_images()
    {
        $guzzleResp = $this->guzzleResp(['images' => [] ]);

        $this->guzzle->get('https://api.digitalocean.com/v2/images?type=distribution&per_page=' . PHP_INT_MAX, ["headers" => ["Authorization" => "Bearer FAKE"]])
            ->willReturn($guzzleResp);

        $resp = $this->gateway->images();

        $this->assertInstanceOf('Rackr\Cloud\Response', $resp);
    }

    /** @test */
    public function it_gets_an_instance()
    {
        $this->assertInstanceOf('Rackr\DigitalOcean\Instance', $this->gateway->instance());
    }
}
 